<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Order\CreateOrderRequest;
use App\Http\Requests\Api\Order\GetOrderRequest;
use App\Http\Requests\Api\Order\UpdateOrderRequest;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Market;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    use PaginateTrait,NotificationTrait;
    public function create_order(CreateOrderRequest $request){
        $cart = userApi()->cart;
        if(count($cart)==0){
            return $this->apiResponse('',__('validation.all_cart_exists'),'simple',500);
        }
        $market_id = $cart[0]->market_id;
        $market = Market::find($market_id);
        if(!($market->status&&$market->block==0)){
            return $this->apiResponse('',__('validation.branch_close'),'simple',500);
        }
        if($request->payment_method=='wallet'&&userApi()->wallet<$request->total){
            return $this->apiResponse('',__('validation.wallet'),'simple',500);
        }
        $data = $request->all();
        $data['market_id'] = $market_id;
        $data['user_id'] = userApi()->id;
        $data['delivery_price'] = $market->delivery_price;
        $order = Order::create($data);
        foreach ($cart as $item) {
            $product = $item->product;
            $order_data['order_id'] = $order->id;
            $order_data['product_id'] = $product->id;
            $order_data['price'] = $product->offer_price??$product->price;
            $order_data['quantity'] = $item->quantity;
            OrderProduct::create($order_data);
        }
        if($request->payment_method=='wallet'){
            $user = userApi();
            $wallet = $user->wallet - $order->total;
            $user->wallet = round($wallet,2);
            $user->save();
        }
        userApi()->cart()->delete();
        app()->setLocale($market->lang);
        $title = __('notification.new_order').$order->id;
        $this->sendFCMNotification([$market_id],$title,$title,'market',
            $order->id,'order');

        return $this->apiResponse($order->id,'success','simple');
    }

    public function get_user_orders(Request $request){
        if(isset($request->to)){
            $to = Carbon::createFromFormat('Y-m-d', $request->to)->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d', $request->from)->startOfDay();
        }else{
            $to = Carbon::createFromFormat('Y-m-d','3000-1-1')->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d','2000-1-1')->startOfDay();
        }
        if(isset($request->status)){
            if($request->status=='complete'){
                $data = get_user_complete_orders($to,$from);
            }else if($request->status=='new'){
                $data = get_user_new_orders($to,$from);
            }else if($request->status=='progress'){
                $data = get_user_in_progress_orders($to,$from);
            }else if($request->status=='canceled'){
                $data = get_user_canceled_orders($to,$from);
            }
        }else{
            $data = get_user_orders($to,$from);
        }
        $data = $data->with(['market'=>function($q){
            $q->select('id','name','logo','paid');
        }]);
        return $this->apiResponse($data);
    }

    public function get_user_order(GetOrderRequest $request){
        $data = Order::where('id',$request->id)->with(['address',
            'products.product','market'])->first();
        return $this->apiResponse($data,'success','simple');
    }


    public function get_market_orders(Request $request){
        if(isset($request->to)){
            $to = Carbon::createFromFormat('Y-m-d', $request->to)->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d', $request->from)->startOfDay();
        }else{
            $to = Carbon::createFromFormat('Y-m-d','3000-1-1')->endOfDay();
            $from = Carbon::createFromFormat('Y-m-d','2000-1-1')->startOfDay();
        }
        if(isset($request->status)){
            if($request->status=='complete'){
                $data = get_market_complete_orders($to,$from);
            }else if($request->status=='new'){
                $data = get_market_new_orders($to,$from);
            }else if($request->status=='progress'){
                $data = get_market_in_progress_orders($to,$from);
            }else if($request->status=='canceled'){
                $data = get_market_canceled_orders($to,$from);
            }
        }else{
            $data = get_market_orders($to,$from);
        }
        $data = $data->with(['user'=>function($q){
            $q->select('id','name','image');
        }]);
        return $this->apiResponse($data);
    }

    public function get_market_order(GetOrderRequest $request){
        $data = Order::where('id',$request->id)->with(['address',
            'products.product','user'])->first();
        return $this->apiResponse($data,'success','simple');
    }

    public function update_order_status(UpdateOrderRequest $request){
        $order = Order::find($request->id);
        $title = null;
        $user = User::find($order->user_id);
        app()->setLocale($user->lang);
        if($order->status != 'canceled' && $order->status != 'complete' && $request->status=='canceled'){
            if($order->payment_method != 'cash'){
                $user = User::find($order->user_id);
                $user->wallet = round($user->wallet + $order->total,2);
                $user->save();
            }
            $title = __('notification.order_canceled').$order->id;
        }else if($order->status == 'delivery' && $request->status=='complete'){
            if($order->payment_method != 'cash'){
                $market = Market::find($order->market_id);
                $market->wallet = round($market->wallet + $order->total,2);
                $market->save();
            }
            $title = __('notification.ended_order').$order->id;
        }else if($order->status == 'new' && $request->status=='in_progress'){
            $title = __('notification.accepted_order').$order->id;
        }else if($order->status == 'in_progress' && $request->status=='delivery'){
            $title = __('notification.delivery_order').$order->id;
        }
        if($title != null){
            $this->sendFCMNotification([$order->user_id],$title,$title,'user',
                $order->id,'order');
        }
        $order->status = $request->status;
        $order->save();
        return $this->apiResponse('success','success','simple');
    }
}
