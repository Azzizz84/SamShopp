<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Order;
use App\Models\ServiceOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class ServiceOrderController extends Controller
{
    use PaginateTrait, NotificationTrait;

    public function all_orders(){
        $orders = ServiceOrder::with(['offers.service_provider' => function($query) {
            $query->withTrashed();
        }])->where(function ($query) {
            $query->whereNull('address_id')->orWhere(function ($q){
                $q->whereHas('address',function ($a){
                    $a->where('city_id',admin_user()->city_id);
                });
            });
        });
        return $orders;
    }
    public function index(){
        $service_orders = $this->all_orders()->get();
        return view('admin.pages.service_order.service_order',compact('service_orders'));
    }
    public function users_orders($type,$id){

        if($type=='user'){
            $service_orders = $this->all_orders()->where('user_id',$id)->get();
        }else if($type=='service_provider'){
            $service_orders = $this->all_orders()->whereHas('offers', function ($query) use ($id) {
                $query->where('status', 'accepted')
                    ->where('service_provider_id', $id);
            })->get();
        }
        return view('admin.pages.service_order.service_order',compact('service_orders'));
    }




    public function delete(Request $request){
        $order = ServiceOrder::find($request->id);
        $order->delete();
        return $this->apiResponse('delete','success','simple');
    }

    public function images($id){
        $service_order = ServiceOrder::find($id);
        return view('admin.pages.service_order.service_order_images',compact('service_order'));
    }
    public function finish_images($id){
        $service_order = ServiceOrder::find($id);
        return view('admin.pages.service_order.service_order_finish_images',compact('service_order'));
    }


}
