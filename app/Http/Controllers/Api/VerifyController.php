<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Setting;
use App\Models\Verify;
use Illuminate\Http\Request;
use DateTime;

class VerifyController extends Controller
{
    use ImageTrait,PaginateTrait;
    public function verify_market(Request $request){
        $data = market_api()->verifies;
        foreach ($data as $value){
            $value->deleteModelImage();
            $value->delete();
        }
        foreach ($request->images as $image){
            $image = $this->addImage($image,'verifies',null,true);
            market_api()->verifies()->create(['image'=>$image]);
        }
        return $this->apiResponse('success','success','simple');
    }

    public function pay_verification_wallet(Request $request)
    {
           
        // three months
        if($request->ty=="one")
        {
        $settings = Setting::first();
        if(market_api()->wallet<$settings->verification_cost){
            return $this->apiResponse('',__('validation.wallet'),'simple',500);
        }
        $time = new DateTime; 
        $expireDate = $time->modify('+3 month')->format('Y-m-d');
        $market = market_api();
        $market->wallet = round($market->wallet - $settings->verification_cost,2);
        $market->paid = 1;
        $market->package_type = 1;
        $market->paid_at =  $time;
        $market->expire_at = $expireDate;
        $market->save();
        return $this->apiResponse('success','success','simple');
        }
        
        // %7 of sale
        else if($request->ty=="two"){
        $settings = Setting::first();
        /*if(market_api()->wallet<$settings->verification_cost_one_year){
            return $this->apiResponse('',__('validation.wallet'),'simple',500);
        }*/
        $timeYear = new DateTime; 
        $expireDateYear = $timeYear->modify('+12 month')->format('Y-m-d');
        $market = market_api();
        $market->wallet = round($market->wallet - 0,2);
        $market->paid = 1;
        $market->package_type = 3;
        $market->paid_at =   $timeYear;
        $market->expire_at = $expireDateYear;
        $market->save();
        return $this->apiResponse('success','success','simple');
        }
        // one year
        else{
        $settings = Setting::first();
        if(market_api()->wallet<$settings->verification_cost_one_year){
            return $this->apiResponse('',__('validation.wallet'),'simple',500);
        }
        $timeYear = new DateTime; 
        $expireDateYear = $timeYear->modify('+12 month')->format('Y-m-d');
        $market = market_api();
        $market->wallet = round($market->wallet - $settings->verification_cost_one_year,2);
        $market->paid = 1;
        $market->package_type = 2;
        $market->paid_at =   $timeYear;
        $market->expire_at = $expireDateYear;
        $market->save();
        return $this->apiResponse('success','success','simple');
    }
    }

   
    public function pay_verification_online(Request $request)
    {
      if($request->ty=="one")
        {
        $settings = Setting::first();
        $data['total'] = $settings->verification_cost;
        $data['user_id'] = market_api()->id;
        $data['type'] = 'verification_market';
        return view('payment',compact('data'));
        }
        else if($request->ty=="two")
        {
        $settings = Setting::first();
        $data['total'] = 0;
        $data['user_id'] = market_api()->id;
        $data['type'] = 'verification_market';
        return view('payment',compact('data'));
        }
        else{
            $settings = Setting::first();
            $data['total'] = $settings->verification_cost_one_year;
            $data['user_id'] = market_api()->id;
            $data['type'] = 'verification_market';
            return view('payment',compact('data'));
        }
    }

}
