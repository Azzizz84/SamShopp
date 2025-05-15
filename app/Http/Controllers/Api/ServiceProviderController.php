<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangeStatusRequest;
use App\Http\Requests\Api\CheckCodeRequest;
use App\Http\Requests\Api\LogoutRequest;
use App\Http\Requests\Api\ServiceProvider\ServiceProviderCanRegisterRequest;
use App\Http\Requests\Api\ServiceProvider\ServiceProviderChangePasswordRequest;
use App\Http\Requests\Api\ServiceProvider\ServiceProviderCheckPhoneRequest;
use App\Http\Requests\Api\ServiceProvider\ServiceProviderRegisterRequest;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\SmsTrait;
use App\Models\ServiceProvider;
use App\Models\ServiceProviderCategory;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;

class ServiceProviderController extends Controller
{
    use PaginateTrait,ImageTrait,SmsTrait;
    public  function login(LoginRequest $request){
        $credentials = $request->only('phone', 'password');
        try {
            $token = serviceProviderAuth()->attempt($credentials);
            if(!$token){
                return $this->apiResponse(null,__('validation.login_field'),'simple',"500");
            }
            $user = ServiceProvider::where('id',service_provider_api()->id)->with('categories')->first();
            if($user->block){
                return  $this->apiResponse('',__('validation.block'),'simple',500);
            }
            createToken($request->token,$user->id,'service_provider');
            $user->token = $token;
            return  $this->apiResponse($user
                ,'success','simple');
        } catch (JWTException $e) {
            return $this->apiResponse(null,__('validation.error'),'simple',"500");
        }

    }

    public function register(ServiceProviderRegisterRequest $request){
        $data = $request->except(['token','categories']);
        $data['password'] = Hash::make($data['password']);
        $user = ServiceProvider::create($data);
        $user = ServiceProvider::where('id',$user->id)->first();
        if($request->hasFile('image')){
            $image = $this->addImage($request->image,'service_provider');
            $user->image = $image;
            $user->save();
        }


        $token =  serviceProviderAuth()->fromUser($user);
        createToken($request->token,$user->id,'service_provider');
        if(isset($request->categories)){
            foreach ($request->categories as $category){
                $user->categories()->attach($category);
            }
        }
        $user = ServiceProvider::where('id',$user->id)->with('categories')->first();
        $user->token = $token;
        return  $this->apiResponse($user,'success','simple');
    }
    public function can_register(ServiceProviderCanRegisterRequest $request){
        $code = $this->send_code($request->phone);
        return  $this->apiResponse($code,'success','simple');
    }
    public function check_phone(ServiceProviderCheckPhoneRequest $request){
        $user = ServiceProvider::where('phone',$request->phone)->with('categories')->first();
        $code = $this->send_code($request->phone);
        return  $this->apiResponse(["user"=>$user,"code"=>$code],'success','simple');
    }
    public function send_code(string $phone) :String{
        $code = rand('100000', '999999');
//        $code = '111111';
        $this->sendOtp($phone, ' '.sendOTPMessage().' ' . $code);
        return  Hash::make($code);
    }
    public function check_code(CheckCodeRequest $request){
        if (Hash::check($request->code, $request->hashed_code)) {
            return $this->apiResponse(null, 'success', 'simple');
        } else {
            return $this->apiResponse(null, __('validation.wrong_code'), 'simple', 409);
        }
    }
    public function update_password(ServiceProviderChangePasswordRequest $request){
        $user = ServiceProvider::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->apiResponse(null, 'success', 'simple');
    }

    public function get_profile(Request $request){
        $user = ServiceProvider::where('id',service_provider_api()->id)->with('categories')->first();
        return $this->apiResponse($user,'success','simple');
    }
    

    public function logout(LogoutRequest $request){
        UserToken::where('token',$request->token)->delete();
        if(serviceProviderAuth()->check()){
            serviceProviderAuth()->logout();
        }
        return $this->apiResponse('success','success','simple');
    }
    public function delete_account(){
        $orders = service_provider_api()->orders()->whereNotIn('status',['complete','canceled'])->count();
        if($orders!=0){
            return $this->apiResponse('success',__('validation.have_order'),'simple',500);
        }
        if(service_provider_api()->wallet<0){
            return $this->apiResponse('success',__('validation.have_wallet_balance'),'simple',500);
        }
        UserToken::where(['user_id'=>service_provider_api()->id,'type'=>'service_provider'])->delete();
        service_provider_api()->delete();
        serviceProviderAuth()->logout();
        return $this->apiResponse('success','success','simple');
    }

    public function update_profile(Request $request){
        if(isset($request->phone)){
            $count = ServiceProvider::where('id','!=',service_provider_api()->id)->where('phone',$request->phone)->count();
            if($count>0){
                return $this->apiResponse(__('validation.unique_phone'),__('validation.unique_phone'),'simple',500);
            }
        }
        if(isset($request->email)){
            $count = ServiceProvider::where('id','!=',service_provider_api()->id)->where('email',$request->email)->count();
            if($count>0){
                return $this->apiResponse(__('validation.unique_email'),__('validation.unique_email'),'simple',500);
            }
        }
        $data = $request->except('image','logo','categories');;
        $user = service_provider_api();

        $user->update($data);
        $user = service_provider_api();
        if($request->hasFile('image')){
            $user = ServiceProvider::find(service_provider_api()->id);
            if($user->image){
                $user->deleteModelImage();
            }
            $image = $this->addImage($request->image,'service_provider');
            $user->image = $image;
            $user->save();
        }


        if(isset($request->categories)){
            ServiceProviderCategory::where('service_provider_id',$user->id)->delete();
            foreach ($request->categories as $category){
                $user->categories()->attach(['category_id'=>$category]);
            }
        }
        $user = ServiceProvider::where('id',service_provider_api()->id)->with('categories')->first();
        return  $this->apiResponse($user,'success','simple');
    }

    public function change_status(ChangeStatusRequest $request){
        $user = service_provider_api();
        $user->online = $request->status;
        $user->save();
        return  $this->apiResponse('success'
            ,'success','simple');
    }
}
