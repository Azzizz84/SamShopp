<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ServiceOrder\CreateServiceOrderOfferRequest;
use App\Http\Requests\Api\ServiceOrder\GetServiceOrderRequest;
use App\Http\Requests\Api\ServiceOrder\UpdateServiceOrderRequest;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\ServiceOrder;
use App\Models\ServiceOrderOffer;
use App\Models\ServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceOrderOfferController extends Controller
{
    use PaginateTrait,NotificationTrait;

    public function get_service_order_offers(GetServiceOrderRequest $request){
        $data = ServiceOrder::find($request->id)->offers()->where('status','progress')->with(['service_provider'=>function($q){
            $q->select('id','name','phone','image',);
        }]);
        return $this->apiResponse($data,);
    }

    public function change_offer_status(Request $request){
        if($request->status == 'accepted'){
            $order_offer = ServiceOrderOffer::find($request->id);
            $order_offer->status = 'accepted';
            $id = $order_offer->service_provider_id;
            $service_provider = ServiceProvider::find($id);
            ServiceOrderOffer::where('id','!=',$request->id)->where('service_order_id',$order_offer->service_order_id)->where('status','progress')->update(['status'=>'closed']);
            $order = $order_offer->service_order;
            $order_offer->save();
            app()->setLocale($service_provider->lang);
            $title = __('notification.offer_accepted').$order->id;
            $data = $this->sendFCMNotification([$id],$title,$title,'service_provider',
                $order->id,'service_order');
            $order->update(['status'=>'in_progress']);


        }else{
            ServiceOrderOffer::find($request->id)->update(['status'=>'refused']);
        }
        return $this->apiResponse('success','success','simple');
    }

    public function create_offer(CreateServiceOrderOfferRequest $request){
        $order = ServiceOrder::where('id',$request->service_order_id)->first();
        if($order->status != 'new'){
            return $this->apiResponse('error',__('validation.order_exists'),'simple',500);
        }
        $data = ServiceOrderOffer::where(['service_provider_id' => service_provider_api()->id,
            'service_order_id' => $request->service_order_id])->first();
        if(!$data){
            $service_order = service_provider_api()->offers()->create($request->all());
            $order = service_provider_api()->offers()->find($service_order->id)->service_order;
            $user = User::find($order->user_id);
            app()->setLocale($user->lang);
            $title = __('notification.new_offer').$order->id;
            $this->sendFCMNotification([$user->id],$title,$title,'user',
                $order->id,'service_order_offer');
        }

        return $this->apiResponse('success','success','simple');
    }

    public function get_offer_id(Request $request){
        $data = ServiceOrderOffer::where('id',$request->id)->with(['service_provider'=>function($q){
            $q->select('id','name','phone','image',);
        }])->first();
        return $this->apiResponse($data,'success','simple');
    }
}
