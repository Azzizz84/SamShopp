<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Order;
use App\Models\ServiceOrder;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use PaginateTrait,NotificationTrait;
    public function index(){
        $users = User::all();
        return view('admin.pages.users.users',compact('users'));

    }
    public function user_details($id){
        $users = User::where('id',$id)->get();
        return view('admin.pages.users.users',compact('users'));
    }
    public function update_wallet(Request $request){
        $user = User::find($request->user_id);
        $language = $user->lang;
        app()->setLocale($language);
        $user->update(["wallet"=>$request->wallet]);
        $title = __('notification.wallet_updated');
        $body = __('notification.your_balance').' '.$request->wallet;
        $this->sendFCMNotification([$request->user_id],$title,$body,'user');
        return $this->apiResponse('success','success','simple');
    }
    public function update_block(Request $request){
        $user = User::find($request->id);
        User::find($request->id)->update(["block"=>$user->block==0?1:0]);
        return $this->apiResponse('success','success','simple');
    }
    public function delete(Request $request){
        User::find($request->id)->delete();
        Order::where('user_id',$request->id)->whereNotIn('status',['complete','canceled'])->update(['status'=>'canceled']);
        ServiceOrder::where('user_id',$request->id)->whereNotIn('status',['complete','canceled'])->update(['status'=>'canceled']);
        return $this->apiResponse('delete','success','simple');
    }


}
