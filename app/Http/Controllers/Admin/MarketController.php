<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Category;
use App\Models\Market;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DateTime;

class MarketController extends Controller
{
    use PaginateTrait,ImageTrait,NotificationTrait;
    public function index(){
        $markets = Market::where('city_id',admin_user()->city_id)->get();
        return view('admin.pages.markets.markets',compact('markets'));
    }
    public function market_details($id){
        $markets = Market::where('id',$id)->where('city_id',admin_user()->city_id)->get();
        return view('admin.pages.markets.markets',compact('markets'));
    }
    public function delete(Request $request){
        $market = Market::find($request->id);

        $orders = $market->orders()->whereNotIn('status',['canceled','completed',]);
        foreach ($orders as $order){
            $order->status = "canceled";
            $order->save();
            $user = User::find($order->user_id);
            $language = $user->lang;
            app()->setLocale($language);
            $title = __('notification.order_canceled_from_admin').$order->id;
            if($order->payment_method!='cash'){
                $user->wallet = round($user->wallet + $order->total,2);
                $user->save();
            }
            $this->sendFCMNotification([$user->id],$title,$title,'user',
                $order->id,'order');
        }
        $market->delete();


        return $this->apiResponse('delete','success','simple');
    }
    public function update_wallet(Request $request){
        $user = Market::find($request->user_id);
        $language = $user->lang;
        app()->setLocale($language);
        $user->update(["wallet"=>$request->wallet]);
        $title = __('notification.wallet_updated');
        $body = __('notification.your_balance').' '.$request->wallet;
        $this->sendFCMNotification([$request->user_id],$title,$body,'market');
        return $this->apiResponse('success','success','simple');
    }
    public function update_block(Request $request){
        $user = Market::find($request->id);
        Market::find($request->id)->update(["block"=>$user->block==0?1:0]);
        return $this->apiResponse('success','success','simple');
    }


    public function verifications($id){
        $verifications = Market::find($id)->verifies;
        return view('admin.pages.markets.verification',compact('verifications'));
    }
    public function update_active(Request $request){
       // $time = new DateTime; 
        //$expireDateYear = $time->modify('+0 month')->format('Y-m-d');
        $user = Market::find($request->id);
        Market::find($request->id)->update(["verified"=>$user->verified==0?1:0]);
       // Market::find($request->id)->update(["paid"=>$user->paid==0]);
        Market::find($request->id)->update(["package_type"=>$user->package_type==0]);
       // Market::find($request->id)->update(["paid_at"=>$user->paid_at=='0000-00-00 00:00:00']);
       // Market::find($request->id)->update(["expire_at"=>$user->expire_at==$expireDateYear]);
        return $this->apiResponse('success','success','simple');
    }

}
