<?php

namespace App\Http\Middleware;

use App\Http\Traits\PaginateTrait;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthMiddleware
{

    use PaginateTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = (request()->header('Authorization'))??($request->query('Authorization'));
        $request->headers->set('auth_token' , (string) $token ,true);
        $request->headers->set('Authorization' , 'Bearer ' .  $token ,true);
        try {
            $user = JWTAuth::parseToken()->authenticate();
            $lang = $request->header('lang')??"ar";
            if(authApi()->check()){
                $user = userApi();
                $user->lang = $lang;
                $user->save();
            }
            if(marketAuth()->check()){
                $user = market_api();
                $user->lang = $lang;
                $user->save();
            }
            if(serviceProviderAuth()->check()){
                $user = service_provider_api();
                $user->lang = $lang;
                $user->save();
            }
            app()->setLocale($lang);
        }
        catch (TokenExpiredException $e){
            return $this->apiResponse(null,__('validation.login_field'),'simple','401',false,401);
        }
        catch (JWTException $e){
            return $this->apiResponse(null,__('validation.login_field'),'simple','401',false,401);
        }
        return $next($request);
    }
}
