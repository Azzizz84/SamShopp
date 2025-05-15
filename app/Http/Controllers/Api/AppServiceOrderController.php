<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AppServiceOrder\GetAppServiceOrderRequest;
use App\Http\Requests\Api\ServiceOrder\CreateServiceOrderRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\AppService;
use App\Models\AppServiceOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AppServiceOrderController extends Controller
{
    use PaginateTrait,ImageTrait,NotificationTrait;

    public function get_services(Request $request)
    {
        $data = AppService::query();
        if(isset($request->category_id)){
            $data = $data->where('category_id',$request->category_id);
        }
        if(isset($request->sub_category_id)){
            $data = $data->where('sub_category_id',$request->sub_category_id);
        }
        if(isset($request->search)){
            $data = $data->where('title_ar','like','%'.$request->search.'%')
                ->orWhere('title_en','like','%'.$request->search.'%');
        }
        return $this->apiResponse($data);
    }

    
    public function create_app_service_order(CreateServiceOrderRequest $request){
        $data = $request->except('video','video_image','images');
        $data['user_id'] = userApi()->id;
        $data['price'] = AppService::find($request->app_service_id)->offer_price ?? AppService::find($request->app_service_id)->price;
        $data['deposit'] = AppService::find($request->app_service_id)->deposit;
        $service_order = AppServiceOrder::create($data);
        $service_order = AppServiceOrder::find($service_order->id);
        if(isset($request->video)){
            if($request->has('video')){
                $video = $this->addImage($request->video,'app_service_orders');
                $videoImage = $this->addImage($request->video_image,'app_service_orders');
                $service_order->video = $video;
                $service_order->video_image = $videoImage;
            }
        }
        if(isset($request->images)){
            if($request->has('images')){
                foreach ($request->images as $image){
                    $image = $this->addImage($image,'app_service_orders');
                    $service_order->images()->create([
                        'image' => $image
                    ]);
                }
            }
        }
        $service_order->save();
        return $this->apiResponse($service_order->id,'success','simple');
    }

    public function get_user_app_service_orders(Request $request){
        if(isset($request->to)){
            $to = Carbon::createFromFormat('Y-m-d', $request->to)->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d', $request->from)->startOfDay();
        }else{
            $to = Carbon::createFromFormat('Y-m-d','3000-1-1')->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d','2000-1-1')->startOfDay();
        }
        if(isset($request->status)){
            if($request->status=='complete'){
                $data = get_user_complete_app_service_orders($to,$from);
            }else if($request->status=='new'){
                $data = get_user_new_app_service_orders($to,$from);
            }else if($request->status=='progress'){
                $data = get_user_in_progress_app_service_orders($to,$from);
            }else if($request->status=='canceled'){
                $data = get_user_canceled_app_service_orders($to,$from);
            }
        }else{
            $data = get_user_app_service_orders($to,$from);
        }
        $data = $data->with(['address','service'])->get();
        return $this->apiResponse($data);
    }

    public function get_user_app_service_order(GetAppServiceOrderRequest $request){
        $data = AppServiceOrder::with(['address',
            'images','service'])->find($request->id);
        return $this->apiResponse($data,'success','simple');
    }

    public function change_app_service_order_deposit_status(GetAppServiceOrderRequest $request){
        $order = AppServiceOrder::find($request->id);
        if(!$order->deposit_paid){

            if($request->payment_method == 'wallet'){
                $user = User::find($order->user_id);
                $user->wallet = round(($user->wallet - $order->deposit),2);
                $user->save();
            }
            $order->deposit_paid = 1;
            $user = $order->user;
            app()->setLocale($user->lang);
            $title = __('notification.deposit_paid').$order->id;
            $this->sendFCMNotification([$order->user_id],$title,$title,'user',
                $request->id,'app_service_deposit');

            $order->save();
        }

        return $this->apiResponse('success','success','simple');
    }
    public function update_user_app_service_order_status(GetAppServiceOrderRequest $request){
        $order = AppServiceOrder::find($request->id);

        if($order->status == 'new' && $request->status=='canceled'){

        }else if($order->status == 'service_provider_finish' && $request->status=='complete'){
            $deposit = $order->deposit??0;
            if($request->payment_method == 'wallet'){
                $user = User::find($order->user_id);
                $total = $order->price;
                $total -= $deposit;
                $user->wallet = round(($user->wallet - $total),2);
                $user->save();
            }
            $order->payment_method = $request->payment_method;
        }
        $order->status = $request->status;
        $order->save();
        return $this->apiResponse('success','success','simple');
    }
}
