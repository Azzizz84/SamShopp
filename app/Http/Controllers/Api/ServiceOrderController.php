<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ServiceOrder\CreateServiceOrderRequest;
use App\Http\Requests\Api\ServiceOrder\GetServiceOrderRequest;
use App\Http\Requests\Api\ServiceOrder\UpdateServiceOrderRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\ServiceOrder;
use App\Models\ServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServiceOrderController extends Controller
{
    use PaginateTrait,ImageTrait,NotificationTrait;

    public function create_service_order(CreateServiceOrderRequest $request){
        $data = $request->except('video','video_image','images');
        $data['user_id'] = userApi()->id;
        $service_order = ServiceOrder::create($data);
        $service_order = ServiceOrder::find($service_order->id);
        if(isset($request->video)){
            if($request->has('video')){
                $video = $this->addImage($request->video,'service_orders');
                $videoImage = $this->addImage($request->video_image,'service_orders');
                $service_order->video = $video;
                $service_order->video_image = $videoImage;
            }
        }

        if(isset($request->images)){
            if($request->has('images')){
                foreach ($request->images as $image){
                    $image = $this->addImage($image,'service_orders');
                    $service_order->images()->create([
                        'image' => $image
                    ]);
                }
            }
        }
        $sub_category_id = $service_order->sub_category_id;
        $service_providers = ServiceProvider::where('online',1)->where('block',0)->whereHas('categories',function ($q) use ($sub_category_id){
            $q->whereHas('subCategories',function ($q) use ($sub_category_id){
                $q->where('id',$sub_category_id);
            });
        })->get();

        foreach ($service_providers as $service_provider){
            app()->setLocale($service_provider->lang);
            $title = __('notification.there_is_order_service').$service_order->id;
            $this->sendFCMNotification([$service_provider->id],$title,$title,'service_provider',
                $service_order->id,'service_order');
        }
        $service_order->save();
        return $this->apiResponse($service_order->id,'success','simple');
    }

    public function get_user_service_orders(Request $request){
        if(isset($request->to)){
            $to = Carbon::createFromFormat('Y-m-d', $request->to)->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d', $request->from)->startOfDay();
        }else{
            $to = Carbon::createFromFormat('Y-m-d','3000-1-1')->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d','2000-1-1')->startOfDay();
        }
        if(isset($request->status)){
            if($request->status=='complete'){
                $data = get_user_complete_service_orders($to,$from);
            }else if($request->status=='new'){
                $data = get_user_new_service_orders($to,$from);
            }else if($request->status=='progress'){
                $data = get_user_in_progress_service_orders($to,$from);
            }else if($request->status=='canceled'){
                $data = get_user_canceled_service_orders($to,$from);
            }
        }else{
            $data = get_user_service_orders($to,$from);
        }
        $data = $data->with(['address'])->get();
        return $this->apiResponse($data);
    }

    public function get_user_service_order(GetServiceOrderRequest $request){
        $data = ServiceOrder::where('id',$request->id)->with(['address',
            'images','service_images'])->first();
        return $this->apiResponse($data,'success','simple');
    }

    public function get_service_provider_orders(Request $request){
        if(isset($request->to)){
            $to = Carbon::createFromFormat('Y-m-d', $request->to)->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d', $request->from)->startOfDay();
        }else{
            $to = Carbon::createFromFormat('Y-m-d','3000-1-1')->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d','2000-1-1')->startOfDay();
        }
        if(isset($request->status)){
            if($request->status=='complete'){
                $data = get_service_provider_complete_orders($to,$from);
            }else if($request->status=='progress'){
                $data = get_service_provider_in_progress_orders($to,$from);
            }else if($request->status=='canceled'){
                $data = get_service_provider_canceled_orders($to,$from);
            }else if($request->status=='ended'){
                $data = get_service_provider_ended_orders($to,$from);
            }
        }else{
            $data = get_service_provider_orders($to,$from);
        }
        $data = $data->with(['user'=>function($q){
            $q->select('id','name','image','phone');
        },'address']);
        return $this->apiResponse($data);
    }

    public function get_service_provider_order(GetServiceOrderRequest $request){
        $data = ServiceOrder::where('id',$request->id)->with(['address',
            'images','service_images','user'=>function($q){
                $q->select('id','name','image','phone');
            }])->first();
        if(($data->accepted_offer!=null&&$data->accepted_offer->service_provider_id!=service_provider_api()->id)
        ||($data->accepted_offer==null&&$data->status!='new')){
            return $this->apiResponse('error',__('validation.order_exists'),'simple',500);
        }
        return $this->apiResponse($data,'success','simple');
    }

    public function get_service_provider_new_orders(Request $request){
        $ids = service_provider_api()->categories->pluck('id')->toArray();
        $orders = ServiceOrder::where('status','new')->whereHas('sub_category', function($query) use ($ids) {
            $query->whereIn('category_id', $ids);
        })->with(['user'=>function($q){
            $q->select('id','name','image','phone');
        },'address']);

        if(isset($request->city_id)){
            $orders = $orders->whereHas('address', function($query) use ($request) {
                $query->where('city_id', $request->city_id);
            });
        }
        $orders->get()->makeHidden(['service_provider', 'accepted_offer']);
        return $this->apiResponse($orders);
    }

    public function update_user_service_order_status(UpdateServiceOrderRequest $request){
        $order = ServiceOrder::find($request->id);

        if($order->status == 'new' && $request->status=='canceled'){

        }else if($order->status == 'service_provider_finish' && $request->status=='complete'){
            $percentage = $order->category->percentage;
            if($order->sub_category->percentage){
                $percentage = $order->sub_category->percentage;
            }
            $service_provider = ServiceProvider::find($order->accepted_offer->service_provider_id);
            $deposit = $order->accepted_offer->deposit??0;
            if($request->payment_method == 'cash'){
                $total = $order->accepted_offer->price;
                $total =  (($total * $percentage) / 100);
                $service_provider->wallet = round($service_provider->wallet - $total,2);
                $service_provider->save();
            }else{
                $total = $order->accepted_offer->price;
                $total = $total - (($total * $percentage) / 100);
                $total -= $deposit;
                $service_provider->wallet = round($service_provider->wallet + $total,2);
                $service_provider->save();
            }

            if($request->payment_method == 'wallet'){
                $user = User::find($order->user_id);
                $total = $order->accepted_offer->price;
                $total -= $deposit;
                $user->wallet = round(($user->wallet - $total),2);
                $user->save();
            }
            $order->payment_method = $request->payment_method;

            app()->setLocale($service_provider->lang);
            $title = __('notification.ended_order').$order->id;
            $this->sendFCMNotification([$service_provider->id],$title,$title,'service_provider',
                $order->id,'service_order');
        }
        $order->status = $request->status;
        $order->save();
        return $this->apiResponse('success','success','simple');
    }

    public function update_service_provider_order_status(UpdateServiceOrderRequest $request){
        $order = ServiceOrder::find($request->id);
        $user = User::find($order->user_id);
        if($order->status == 'in_progress' && $request->status=='service_provider_finish'){
            if(isset($request->images)){
                foreach ($request->images as $image){
                    $imagePath = $this->addImage($image,'service_orders');
                    $order->finished_images()->create([
                        'image' => $imagePath
                    ]);
                }
            }
            app()->setLocale($user->lang);
            $title = __('notification.ended_service_order').$order->id;
            $this->sendFCMNotification([$order->user_id],$title,$title,'user',
                $order->id,'service_order');
        }else if(($order->status == 'in_progress'||$order->status == 'service_provider_finish') &&
            $request->status=='canceled'){
            if($order->diposit_paid == 1){
                $user = User::find($order->user_id);
                $user->wallet = round($user->wallet + $order->accepted_offer->diposit,2);
                $user->save();
            }
            app()->setLocale($user->lang);
            $title = __('notification.service_order_canceled_from_provider').$order->id;
            $this->sendFCMNotification([$order->user_id],$title,$title,'user',
                $order->id,'service_order');
        }
        $order->status = $request->status;
        $order->save();
        return $this->apiResponse('success','success','simple');
    }

    public function change_deposit_status(GetServiceOrderRequest $request){
        $order = ServiceOrder::find($request->id);
        if(!$order->deposit_paid){

            if($request->payment_method == 'wallet'){
                $user = User::find($order->user_id);
                $user->wallet = round(($user->wallet - $order->accepted_offer->deposit),2);
                $user->save();
            }
            $order->deposit_paid = 1;
            $user = $order->user;
            app()->setLocale($user->lang);
            $title = __('notification.deposit_paid').$order->id;
            $this->sendFCMNotification([$order->user_id],$title,$title,'user',
                $request->id,'deposit');

            $user = $order->accepted_offer->service_provider;
            $service_provider = ServiceProvider::find($user->id);
            $service_provider->wallet = round($service_provider->wallet + $order->accepted_offer->diposit,2);
            $service_provider->save();
            app()->setLocale($user->lang);
            $title = __('notification.deposit_paid').$order->id;
            $this->sendFCMNotification([$user->id],$title,$title,'service_provider',
                $request->id,'deposit');
            $order->save();
        }

        return $this->apiResponse('success','success','simple');
    }
}
