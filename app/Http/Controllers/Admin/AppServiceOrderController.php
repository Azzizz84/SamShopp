<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\AppServiceOrder;
use App\Models\Order;
use App\Models\ServiceOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class AppServiceOrderController extends Controller
{
    use PaginateTrait, NotificationTrait;

    public function all_orders(){
        $orders = AppServiceOrder::where(function ($query) {
            $query->whereNull('address_id')->orWhere(function ($q){
                $q->whereHas('address',function ($a){
                    $a->where('city_id',admin_user()->city_id);
                });
            });
        });
        return $orders;
    }
    public function index(){
        $app_service_orders = $this->all_orders()->get();
        return view('admin.pages.app_service_order.app_service_order',compact('app_service_orders'));
    }
    public function users_orders($id){

        $app_service_orders = $this->all_orders()->where('user_id',$id)->get();
        return view('admin.pages.app_service_order.app_service_order',compact('app_service_orders'));
    }




    public function delete(Request $request){
        $order = AppServiceOrder::find($request->id);
        $order->delete();
        return $this->apiResponse('delete','success','simple');
    }

    public function images($id){
        $service_order = AppServiceOrder::find($id);
        return view('admin.pages.service_order.service_order_images',compact('service_order'));
    }

    public function update_order(Request $request){
        $order = AppServiceOrder::find($request->id);
        $user = User::find($order->user_id);
        app()->setLocale($user->lang);
        $title = null;
        if($request->status=='in_progress'){
            $title = __('notification.accepted_order').$order->id;
        }else if($request->status=='service_provider_finish'){
            $title = __('notification.ended_service_order').$order->id;
        }else if($request->status=='complete'){
            $title = __('notification.ended_order').$order->id;
        }else if($request->status=='canceled'){
            $title = __('notification.service_order_canceled_from_provider').$order->id;
        }
        $order->status = $request->status;
        if($title){
            $this->sendFCMNotification([$order->user_id],$title,$title,'user',
                $order->id,'app_service_order');
        }
        $order->save();
        return $this->apiResponse('success','success','simple');
    }




}
