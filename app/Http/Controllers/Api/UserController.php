<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CheckCodeRequest;
use App\Http\Requests\Api\LogoutRequest;
use App\Http\Requests\Api\User\CanRegisterRequest;
use App\Http\Requests\Api\User\ChangePasswordRequest;
use App\Http\Requests\Api\User\ChargeWalletRequest;
use App\Http\Requests\Api\User\CheckPhoneRequest;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Requests\Api\User\RegisterRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\SmsTrait;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\UserToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\Api\User\CheckEmailRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class UserController extends Controller
{
    use PaginateTrait,ImageTrait,SmsTrait;
     public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        try {
            $token = authApi()->attempt($credentials);
            if(!$token){
                return $this->apiResponse(null, __('validation.login_field'), 'simple', "500");
            }
            $user = User::where('id', userApi()->id)->first();
            if($user->block){
                return $this->apiResponse('', __('validation.block'), 'simple', 500);
            }
            createToken($request->token, $user->id, 'user');
            $user->token = $token;
            return $this->apiResponse($user, 'success', 'simple');
        } catch (JWTException $e) { 
            return $this->apiResponse(null, __('validation.error'), 'simple', "500");
        }
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->except(['token']);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        
        if($request->hasFile('image')){
            $image = $this->addImage($request->image, 'users');
            $user->image = $image;
            $user->save();
        }
        
        $user = User::where('id', $user->id)->first();
        $token = authApi()->fromUser($user);
        createToken($request->token, $user->id, 'user');
        $user->token = $token;
        return $this->apiResponse($user, 'success', 'simple');
    }

     public function can_register(CanRegisterRequest $request)
    {
        $code = $this->send_email_code($request->email);
        return $this->apiResponse($code, 'success', 'simple');
    }

     public function check_email(CheckEmailRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        $code = $this->send_email_code($request->email);
        return $this->apiResponse(["user" => $user, "code" => $code], 'success', 'simple');
    }

    public function send_email_code(string $email): string
{
    $code = strval(rand(1000, 9999)); // Ensure string type
    // $code = '1111'; // For testing
    
    try {
        Mail::to($email)->send(new OtpMail($code));
        return Hash::make($code);
    } catch (\Exception $e) {
        // Log error and return a default hash if needed
        \Log::error('OTP Email Failed: '.$e->getMessage());
        return Hash::make('0000'); // Fallback
    }
}

     public function check_code(CheckCodeRequest $request)
    {
        if (Hash::check($request->code, $request->hashed_code)) {
            return $this->apiResponse(null, 'success', 'simple');
        } else {
            return $this->apiResponse(null, __('validation.wrong_code'), 'simple', 409);
        }
    }

    public function check_phone(CheckPhoneRequest $request){
        $user = User::where('phone',$request->phone)->first();
        $code = $this->send_code($request->phone);
        return  $this->apiResponse(["user"=>$user,"code"=>$code],'success','simple');
    }
    public function send_code(string $phone) :String{
        $code = rand('1000', '9999');
//        $code = '1111';
        $this->sendOtp($phone, ' '.sendOTPMessage().' ' . $code);
        return  Hash::make($code);
    }

    public function update_password(ChangePasswordRequest $request){
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->apiResponse(null, 'success', 'simple');
    }

    public function get_profile(Request $request){
        $user = auth()->user();
        $user = User::where('id',$user->id)->first();
        return $this->apiResponse($user,'success','simple');
    }
    public function charge_wallet(ChargeWalletRequest $request){
        $user = auth()->user();
        $user->wallet = round($user->wallet+$request->money,2);
        $user->save();
        $user = User::where('id',$user->id)->first();
        return $this->apiResponse($user,'success','simple');
    }

    public function charge_wallet_Ser(ChargeWalletRequest $request){
        $user = auth()->user();
        $user->wallet = round($user->wallet+$request->money,2);
        $user->save();
        $user = ServiceProvider::where('id',$user->id)->first();
        return $this->apiResponse($user,'success','simple');
    }


    public function logout(LogoutRequest $request){
        UserToken::where('token',$request->token)->delete();
        if(authApi()->check()){
            authApi()->logout();
        }
        return $this->apiResponse('success','success','simple');
    }
    public function delete_account(){
        $orders = userApi()->orders()->whereNotIn('status',['complete','canceled'])->count();
        if($orders!=0){
            return $this->apiResponse('success',__('validation.have_order'),'simple',500);
        }
        $orders = userApi()->service_orders()->whereNotIn('status',['complete','canceled'])->count();
        if($orders!=0){
            return $this->apiResponse('success',__('validation.have_order'),'simple',500);
        }
        UserToken::where('user_id',userApi()->id)->where('type','user')->delete();
        userApi()->delete();
        authApi()->logout();
        return $this->apiResponse('success','success','simple');
    }

     public function update_profile(Request $request){

        try{
        if(isset($request->phone)){
            $count = User::where('id','!=',userApi()->id)->where('phone',$request->phone)->count();
            if($count>0){
                return $this->apiResponse(__('validation.unique_phone'),__('validation.unique_phone'),'simple',500);
            }
        }
        if(isset($request->email)){
            $count = User::where('id','!=',userApi()->id)->where('email',$request->email)->count();
            if($count>0){
                return $this->apiResponse(__('validation.unique_email'),__('validation.unique_email'),'simple',500);
            }
        }
        $data = $request->except('image');
        $user = userApi();

        $user->update($data);
        
        if($request->hasFile('image')){
            try {
            $user = User::find(userApi()->id);
            if($user->image){
                $user->deleteUserImage();
            }
            $image = $this->addImage($request->image,'users');
            $user->image = $image;
            $user->save();
             } catch (\Exception $e) {
                \Log::error('Image upload failed: ' . $e->getMessage());
                return $this->apiResponse('Image upload failed', 'error', 'simple', 500);
            }
        }
        $user = User::where('id',userApi()->id)->first();
        return  $this->apiResponse($user,'success','simple');

        } catch (\Exception $e) {
        \Log::error('Profile update failed: ' . $e->getMessage());
        return $this->apiResponse('Profile update failed', 'error', 'simple', 500);
    }
    }
}
