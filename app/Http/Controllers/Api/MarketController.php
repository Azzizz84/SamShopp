<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChangeStatusRequest;
use App\Http\Requests\Api\CheckCodeRequest;
use App\Http\Requests\Api\LogoutRequest;
use App\Http\Requests\Api\Market\GetMarketDetailsRequest;
use App\Http\Requests\Api\Market\MarketCanRegisterRequest;
use App\Http\Requests\Api\Market\MarketChangePasswordRequest;
use App\Http\Requests\Api\Market\MarketCheckPhoneRequest;
use App\Http\Requests\Api\Market\MarketRegisterRequest;
use App\Http\Requests\Api\User\LoginRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Http\Traits\SmsTrait;
use App\Models\Category;
use App\Models\Market;
use App\Models\MarketCategory;
use App\Models\Setting;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class MarketController extends Controller
{
    use PaginateTrait,ImageTrait,SmsTrait;

    public function get_markets(Request $request){
        $data = Market::query();
        if(isset($request->category_id)){
            $ids = Category::find($request->category_id)->markets->pluck('id')->toArray();
            $data = $data->whereIn('id',$ids);
        }
        if(isset($request->search)){
            $data = $data->where('name','like','%'.$request->search.'%');
        }
        if(isset($request->city_id)){
            $data = $data->where('city_id',$request->city_id);
        }
        if(isset($request->app_market)){
            $data = $data->where('app_market',$request->app_market);
        }
        if(isset($request->lat)){
            $userLatitude  = $request->input('lat');
            $userLongitude = $request->input('lng');
            $data =  $data->selectRaw(
                'markets.*,
    (6371 * acos(cos(radians(?)) * cos(radians(lat)) * cos(radians(lng) - radians(?)) + sin(radians(?)) * sin(radians(lat)))) AS distance',
                [$userLatitude, $userLongitude, $userLatitude]
            )
                ->orderBy('distance');
        }else{
            $data = $data->inRandomOrder();
        }


        return $this->apiResponse($data,'success','object',200,isset($request->lat));
    }

    public function get_market_details(GetMarketDetailsRequest $request){
        $market = Market::where('id',$request->id)->with('sections.products')->first();
        return $this->apiResponse($market,'success','simple');
    }


    public  function login(LoginRequest $request){
        $credentials = $request->only('phone', 'password');
        try {
            $token = marketAuth()->attempt($credentials);
            if(!$token){
                return $this->apiResponse(null,__('validation.login_field'),'simple',"500");
            }
            $user = Market::where('id',market_api()->id)->with('categories')->first();
            if($user->block){
                return  $this->apiResponse('',__('validation.block'),'simple',500);
            }
            if(isset($request->token)){
                createToken($request->token,$user->id,'market');
            }
            $user->token = $token;
            return  $this->apiResponse($user
                ,'success','simple');
        } catch (JWTException $e) {
            return $this->apiResponse(null,__('validation.error'),'simple',"500");
        }

    }

    public function register(MarketRegisterRequest $request){
        $settings = Setting::first();
        $data = $request->except(['token','categories','market_code']);
        if(isset($request->market_code)){
            if($request->market_code != $settings->market_code){
                return $this->apiResponse(__('validation.market_code_not_match'),__('validation.market_code_not_match'),'simple',500);
            }else{
                $data['app_market'] = 1;
                $data['paid'] = 1;
                $data['verified'] = 1;
            }
        }
        $data['password'] = Hash::make($data['password']);
        $user = Market::create($data);
        $user = Market::where('id',$user->id)->first();

        if($request->hasFile('image')){
            $image = $this->addImage($request->image,'markets');
            $user->image = $image;
            $user->save();
        }
        if($request->hasFile('logo')){
            $image = $this->addImage($request->logo,'markets');
            $user->logo = $image;
            $user->save();
        }

        $token =  marketAuth()->fromUser($user);
        if(isset($request->token)){
            createToken($request->token,$user->id,'market');
        }
        if(isset($request->categories)){
            foreach ($request->categories as $category){
                $user->categories()->attach($category);
            }
        }

        $user = Market::where('id',$user->id)->with('categories')->first();
        $user->token = $token;
        return  $this->apiResponse($user,'success','simple');
    }
    public function can_register(MarketCanRegisterRequest $request){
        $settings = Setting::first();
        if(isset($request->market_code)){
            if($request->market_code != $settings->market_code){
                return $this->apiResponse(__('validation.market_code_not_match'),__('validation.market_code_not_match'),'simple',500);
            }
        }
        $code = $this->send_code($request->phone);
        return  $this->apiResponse($code,'success','simple');
    }
    public function check_phone(MarketCheckPhoneRequest $request){
        $user = Market::where('phone',$request->phone)->with('categories')->first();
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
    public function update_password(MarketChangePasswordRequest $request){
        $user = Market::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->apiResponse(null, 'success', 'simple');
    }

    public function get_profile(Request $request){
        $user = Market::where('id',market_api()->id)->with('categories')->first();
        return $this->apiResponse($user,'success','simple');
    }

    public function logout(LogoutRequest $request){
        UserToken::where('token',$request->token)->delete();
       if(marketAuth()->check()){
           marketAuth()->logout();
       }
        return $this->apiResponse('success','success','simple');
    }
    public function delete_account(){
        $orders = market_api()->orders()->whereNotIn('status',['complete','canceled'])->count();
        if($orders!=0){
            return $this->apiResponse('success',__('validation.have_order'),'simple',500);
        }
        UserToken::where(['user_id'=>market_api()->id,'type'=>'market'])->delete();
        market_api()->delete();
        marketAuth()->logout();
        return $this->apiResponse('success','success','simple');
    }

    public function update_profile(Request $request){
        if(isset($request->phone)){
            $count = Market::where('id','!=',market_api()->id)->where('phone',$request->phone)->count();
            if($count>0){
                return $this->apiResponse(__('validation.unique_phone'),__('validation.unique_phone'),'simple',500);
            }
        }
        if(isset($request->email)){
            $count = Market::where('id','!=',market_api()->id)->where('email',$request->email)->count();
            if($count>0){
                return $this->apiResponse(__('validation.unique_email'),__('validation.unique_email'),'simple',500);
            }
        }
        $data = $request->except('image','logo','categories');;
        $user = market_api();
        if(isset($request->password)){
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        $user = market_api();
        if($request->hasFile('image')){
            $user = Market::find(market_api()->id);
            if($user->image){
                 $user->deleteModelImage();
            }
            $image = $this->addImage($request->image,'markets');
            $user->image = $image;
            $user->save();
        }
        if($request->hasFile('logo')){
            $user = Market::find(market_api()->id);
            if($user->logo){
                $user->deleteModelLogo();
            }
            $image = $this->addImage($request->logo,'markets');
            $user->logo = $image;
            $user->save();
        }

        if(isset($request->categories)){
            MarketCategory::where('market_id',$user->id)->delete();
            foreach ($request->categories as $category){
                $user->categories()->attach(['category_id'=>$category]);
            }
        }
        $user = Market::where('id',market_api()->id)->with('categories')->first();
        return  $this->apiResponse($user,'success','simple');
    }

    public function change_status(ChangeStatusRequest $request){
        $market = market_api();
        $market->status = $request->status;
        $market->save();
        return  $this->apiResponse('success'
            ,'success','simple');
    }

    public function refresh_token(Request $request)
    {
        $token = $request->token;
        try {
            if (!$token) {
                return $this->apiResponse(null,__('validation.login_field'),'simple','402');
            }

            $refreshedToken = JWTAuth::refresh(JWTAuth::getToken());
            return response()->json(['token' => $refreshedToken], 200);
        } catch (JWTException $e) {
            return $this->apiResponse(null,__('validation.login_field'),'simple','402');
        }
    }



}
