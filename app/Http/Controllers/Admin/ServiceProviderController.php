<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Order;
use App\Models\ServiceOrder;
use App\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceProviderController extends Controller
{
    use PaginateTrait,NotificationTrait;
    public function index(){
        $service_providers = ServiceProvider::all();
        return view('admin.pages.service_provider.service_provider',compact('service_providers'));

    }
    public function service_provider_details($id){
        $service_providers = ServiceProvider::where('id',$id)->get();
        return view('admin.pages.service_provider.service_provider',compact('service_providers'));
    }
    public function update_wallet(Request $request){
        $user = ServiceProvider::find($request->user_id);
        $language = $user->lang;
        app()->setLocale($language);
        $user->update(["wallet"=>$request->wallet]);
        $title = __('notification.wallet_updated');
        $body = __('notification.your_balance').' '.$request->wallet;
        $this->sendFCMNotification([$request->user_id],$title,$body,'service_provider');
        return $this->apiResponse('success','success','simple');
    }
    public function update_block(Request $request){
        $user = ServiceProvider::find($request->id);
        ServiceProvider::find($request->id)->update(["block"=>$user->block==0?1:0]);
        return $this->apiResponse('success','success','simple');
    }
    public function delete(Request $request){
        ServiceProvider::find($request->id)->delete();
        $serviceProviderId = $request->id;
        $orders = ServiceOrder::whereHas('offers', function ($query) use ($serviceProviderId) {
            $query->where('status', 'accepted')
                ->where('service_provider_id', $serviceProviderId);
        })->whereNotIn('status',['complete','canceled'])->get();

        foreach($orders as $order){
            if($order->deposit_paid){
                $user = User::find($order->user_id);
                $offer = $order->offers()->where('status','accepted')->first();
                $user->update(['wallet'=>$user->wallet+$offer->deposit]);
            }
            $order->update(['status'=>'canceled']);
        }

        return $this->apiResponse('delete','success','simple');
    }


}
