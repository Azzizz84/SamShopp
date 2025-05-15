<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Cart\AddCartRequest;
use App\Http\Requests\Api\Cart\ChangeCartRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Branch;
use App\Models\Cart;
use App\Models\CartExtra;
use App\Models\CartRemovable;
use App\Models\User;
use Illuminate\Http\Request;

class CartController extends Controller
{
    use  PaginateTrait;
    public function add_to_cart(AddCartRequest $request){
        $cart = userApi()->cart;
        if(count($cart)==0){
            $this->add_product_to_cart($request);
        }else{
            $carts = userApi()->cart()->where('product_id',$request->product_id)->first();
            if(!$carts){
                $this->add_product_to_cart($request);
            }else{
                $this->change_product_cart($carts->id,$request->quantity);
            }
        }
        $data = $this->get_cart();
        return $data;

    }


    public function increase_cart(ChangeCartRequest $request){
        return $this->change_product_cart($request->id);
    }

    public function decrease_cart(ChangeCartRequest $request){
        return $this->change_product_cart($request->id,-1);
    }

    public function delete_cart(){
        userApi()->cart()->delete();
        return $this->apiResponse('success','success','simple');
    }

    public function change_product_cart($cart_id,$quantity = 1){
        $cart = Cart::find($cart_id);
        $cart->quantity = $cart->quantity+$quantity;
        if($cart->quantity==0){
            $cart->delete();
        }else{
            $cart->save();
        }
        return $this->apiResponse('success','success','simple');
    }

    public function add_product_to_cart(AddCartRequest $request){
        $data = $request->only('market_id','product_id','quantity');
        $data['user_id'] = userApi()->id;
        $cart = Cart::create($data);
        return $this->apiResponse('success','success','simple');
    }

    public function get_cart(){
        $cart = userApi()->cart()->with(["product",'market'=>function($q){
            $q->select('id','delivery_price','city_id');
        }]);
        return $this->apiResponse($cart);
    }
}
