<?php


use App\Models\Order;
use App\Models\Setting;
use App\Models\UserToken;
if (!function_exists('createToken')) {
    function createToken($token,$userId,$type,$remove = false)
    {
        UserToken::where('token',$token)->delete();
        if($remove){
            UserToken::where('user_id',$userId)->where('type',$type)->delete();
        }
        UserToken::create([
            "token"=>$token,
            'user_id'=>$userId,
            'type'=>$type,
        ]);
    }
}


if(!function_exists('convertMapToString')){
    function convertMapToString($data) : string{
        $msg = '';
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $msg .= implode("\n", $value) . "\n";
            } elseif (is_string($value)) {
                $msg .= "$value\n";
            }
        }
        // Remove trailing newline if present
        if (substr($msg, -1) === "\n") {
            $msg = substr($msg, 0, -1);
        }
        return $msg;
    }
}
if(!function_exists('handleErrorMessage')){
    function handleErrorMessage($data) : string{
        if (is_array($data)) {
            $msg = convertMapToString($data);
        } elseif (is_string($data)) {
            $msg = $data;
        } else {
            // Handle other types of messages as needed
            $msg = 'UnKnown';
        }
        return  $msg;
    }
}

if (!function_exists('userApi')) {
    function userApi()
    {
        return auth()->guard('user_api')->user();
    }
}
if (!function_exists('authApi')) {
    function authApi()
    {
        return auth()->guard('user_api');
    }
}



if (!function_exists('admin_user')) {
    function admin_user()
    {
        return auth()->guard('admin')->user();
    }
}
if (!function_exists('admin')) {
    function admin()
    {
        return auth()->guard('admin');
    }
}

if (!function_exists('market_api')) {
    function market_api()
    {
        return auth()->guard('market_api')->user();
    }
}
if (!function_exists('marketAuth')) {
    function marketAuth()
    {
        return auth()->guard('market_api');
    }
}

if (!function_exists('service_provider_api')) {
    function service_provider_api()
    {
        return auth()->guard('service_provider_api')->user();
    }
}
if (!function_exists('serviceProviderAuth')) {
    function serviceProviderAuth()
    {
        return auth()->guard('service_provider_api');
    }
}






///////////////// user /////////////

if (!function_exists('filter_user_service_orders')) {
    function filter_user_service_orders($date,$firstDate =  null){
        $user = userApi();
        $orders = $user->service_orders();
        if($firstDate){
            $orders->whereBetween('created_at', [$firstDate,$date]);
        }else{
            $orders->whereDate('created_at', $date);
        }
        return $orders;
    }
}

if (!function_exists('get_user_service_orders')) {
    function get_user_service_orders($date,$firstDate =  null)
    {
        return filter_user_service_orders($date,$firstDate);
    }
}
if (!function_exists('get_user_new_service_orders')) {
    function get_user_new_service_orders($date,$firstDate =  null)
    {
        $orders = filter_user_service_orders($date,$firstDate);
        return $orders->whereIn('status',['new']);
    }
}
if (!function_exists('get_user_in_progress_service_orders')) {
    function get_user_in_progress_service_orders($date,$firstDate =  null)
    {
        $orders = filter_user_service_orders($date,$firstDate);
        return $orders->whereIn('status',['in_progress','service_provider_finish']);
    }
}
if (!function_exists('get_user_complete_service_orders')) {
    function get_user_complete_service_orders($date,$firstDate =  null)
    {
        $orders = filter_user_service_orders($date,$firstDate);
        return $orders->whereIn('status',['complete']);
    }
}
if (!function_exists('get_user_canceled_service_orders')) {
    function get_user_canceled_service_orders($date,$firstDate =  null)
    {
        $orders = filter_user_service_orders($date,$firstDate);
        return $orders->whereIn('status',['canceled']);
    }
}


/// user orders ///


if (!function_exists('filter_user_orders')) {
    function filter_user_orders($date,$firstDate =  null){
        $user = userApi();
        $orders = $user->orders();
        if($firstDate){
            $orders->whereBetween('created_at', [$firstDate,$date]);
        }else{
            $orders->whereDate('created_at', $date);
        }
        return $orders;
    }
}

if (!function_exists('get_user_orders')) {
    function get_user_orders($date,$firstDate =  null)
    {
        return filter_user_orders($date,$firstDate);
    }
}
if (!function_exists('get_user_new_orders')) {
    function get_user_new_orders($date,$firstDate =  null)
    {
        $orders = filter_user_orders($date,$firstDate);
        return $orders->whereIn('status',['new']);
    }
}
if (!function_exists('get_user_in_progress_orders')) {
    function get_user_in_progress_orders($date,$firstDate =  null)
    {
        $orders = filter_user_orders($date,$firstDate);
        return $orders->whereIn('status',['in_progress','delivery']);
    }
}
if (!function_exists('get_user_complete_orders')) {
    function get_user_complete_orders($date,$firstDate =  null)
    {
        $orders = filter_user_orders($date,$firstDate);
        return $orders->whereIn('status',['complete']);
    }
}
if (!function_exists('get_user_canceled_orders')) {
    function get_user_canceled_orders($date,$firstDate =  null)
    {
        $orders = filter_user_orders($date,$firstDate);
        return $orders->whereIn('status',['canceled']);
    }
}


/// market orders ///


if (!function_exists('filter_market_orders')) {
    function filter_market_orders($date,$firstDate =  null){
        $user = market_api();
        $orders = $user->orders();
        if($firstDate){
            $orders->whereBetween('created_at', [$firstDate,$date]);
        }else{
            $orders->whereDate('created_at', $date);
        }
        return $orders;
    }
}

if (!function_exists('get_market_orders')) {
    function get_market_orders($date,$firstDate =  null)
    {
        return filter_market_orders($date,$firstDate);
    }
}
if (!function_exists('get_market_new_orders')) {
    function get_market_new_orders($date,$firstDate =  null)
    {
        $orders = filter_market_orders($date,$firstDate);
        return $orders->whereIn('status',['new']);
    }
}
if (!function_exists('get_market_in_progress_orders')) {
    function get_market_in_progress_orders($date,$firstDate =  null)
    {
        $orders = filter_market_orders($date,$firstDate);
        return $orders->whereIn('status',['in_progress','delivery']);
    }
}
if (!function_exists('get_market_complete_orders')) {
    function get_market_complete_orders($date,$firstDate =  null)
    {
        $orders = filter_market_orders($date,$firstDate);
        return $orders->whereIn('status',['complete']);
    }
}
if (!function_exists('get_market_canceled_orders')) {
    function get_market_canceled_orders($date,$firstDate =  null)
    {
        $orders = filter_market_orders($date,$firstDate);
        return $orders->whereIn('status',['canceled']);
    }
}


///////////////// app service orders /////////////

if (!function_exists('filter_user_app_service_orders')) {
    function filter_user_app_service_orders($date,$firstDate =  null){
        $user = userApi();
        $orders = $user->app_service_orders();
        if($firstDate){
            $orders->whereBetween('created_at', [$firstDate,$date]);
        }else{
            $orders->whereDate('created_at', $date);
        }
        return $orders;
    }
}

if (!function_exists('get_user_app_service_orders')) {
    function get_user_app_service_orders($date,$firstDate =  null)
    {
        return filter_user_app_service_orders($date,$firstDate);
    }
}
if (!function_exists('get_user_new_app_service_orders')) {
    function get_user_new_app_service_orders($date,$firstDate =  null)
    {
        $orders = filter_user_app_service_orders($date,$firstDate);
        return $orders->whereIn('status',['new']);
    }
}
if (!function_exists('get_user_in_progress_app_service_orders')) {
    function get_user_in_progress_app_service_orders($date,$firstDate =  null)
    {
        $orders = filter_user_app_service_orders($date,$firstDate);
        return $orders->whereIn('status',['in_progress','service_provider_finish']);
    }
}
if (!function_exists('get_user_complete_app_service_orders')) {
    function get_user_complete_app_service_orders($date,$firstDate =  null)
    {
        $orders = filter_user_app_service_orders($date,$firstDate);
        return $orders->whereIn('status',['complete']);
    }
}
if (!function_exists('get_user_canceled_app_service_orders')) {
    function get_user_canceled_app_service_orders($date,$firstDate =  null)
    {
        $orders = filter_user_app_service_orders($date,$firstDate);
        return $orders->whereIn('status',['canceled']);
    }
}
//////////////// service provider orders //////////////


if (!function_exists('filter_service_provider_orders')) {
    function filter_service_provider_orders($date,$firstDate =  null){
        $user = service_provider_api();
        $orders = $user->orders();
        if($firstDate){
            $orders->whereBetween('created_at', [$firstDate,$date]);
        }else{
            $orders->whereDate('created_at', $date);
        }
        return $orders;
    }
}


if (!function_exists('get_service_provider_orders')) {
    function get_service_provider_orders($date,$firstDate =  null)
    {
        return filter_service_provider_orders($date,$firstDate);
    }
}

if (!function_exists('get_service_provider_in_progress_orders')) {
    function get_service_provider_in_progress_orders($date,$firstDate =  null)
    {
        $orders = filter_service_provider_orders($date,$firstDate);
        return $orders->whereIn('status',['in_progress','service_provider_finish']);
    }
}
if (!function_exists('get_service_provider_complete_orders')) {
    function get_service_provider_complete_orders($date,$firstDate =  null)
    {
        $orders = filter_service_provider_orders($date,$firstDate);
        return $orders->whereIn('status',['complete']);
    }
}
if (!function_exists('get_service_provider_canceled_orders')) {
    function get_service_provider_canceled_orders($date,$firstDate =  null)
    {
        $orders = filter_service_provider_orders($date,$firstDate);
        return $orders->whereIn('status',['canceled']);
    }
}
if (!function_exists('get_service_provider_ended_orders')) {
    function get_service_provider_ended_orders($date,$firstDate =  null)
    {
        $orders = filter_service_provider_orders($date,$firstDate);
        return $orders->whereIn('status',['canceled','complete']);
    }
}





if (!function_exists('sendOTPMessage')) {
    function sendOTPMessage() :string
    {
        return __('admin.otp');
    }
}

if (!function_exists('convertIntToString')) {
    function convertIntToString($data) :string
    {
        return __('admin.'.($data==1?"yes":"no"));
    }
}
