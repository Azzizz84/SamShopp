<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class OrderController extends Controller
{
    use PaginateTrait, NotificationTrait;

    public function all_orders(){
        $orders = Order::whereHas('address',function ($q){
            $q->where('city_id',admin_user()->city_id);
        })->with(['market' => function($query) {
            $query->withTrashed();
        },'user' => function($query) {
            $query->withTrashed();
        },'address' => function($query) {
            $query->withTrashed();
        }]);
        return $orders;
    }
    public function index(){
        $orders = $this->all_orders()->get();
        return view('admin.pages.order.order',compact('orders'));
    }
    public function users_orders($type,$id){

        if($type=='user'){
            $column = 'user_id';
        }else if($type=='market'){
            $column = 'market_id';
        }
        $orders = $this->all_orders()->where($column,$id)->get();
        return view('admin.pages.order.order',compact('orders'));
    }
    public function order_product($id){
        $order = Order::where('id',$id)->where('city_id',admin_user()->city_id)->with(['products.product'=>function($query) {
            $query->withTrashed();
        }])->first();
        return view('admin.pages.order.order_products',compact('order'));
    }



    public function delete(Request $request){
        $order = Order::find($request->id);
        $order->delete();
        return $this->apiResponse('delete','success','simple');
    }


}
