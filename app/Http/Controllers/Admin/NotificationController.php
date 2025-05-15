<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Branch;
use App\Models\Delivery;
use App\Models\Market;
use App\Models\Notification;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\UsersToken;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use PaginateTrait,NotificationTrait;
    public function index(){
        $notifications = Notification::all();
        return view('admin.pages.notification.notifications',compact('notifications'));
    }
    public function add(){
        return view('admin.pages.notification.add_notification');
    }
    public function store(Request $request){
        $data = $request->all();
        Notification::create($data);
        if($request->type=='user'){
            $tokens = User::pluck('id')->toArray();
        }else if($request->type=='market'){

            $tokens = Market::pluck('id')->toArray();
        }else{
            $tokens = ServiceProvider::pluck('id')->toArray();
        }
        foreach ($tokens as $id){
            if($request->type=='user'){
                $lang = User::find($id)->lang;
            }else if($request->type=='market'){
                $lang = Market::find($id)->lang;
            }else{
                $lang = ServiceProvider::find($id)->lang;
            }
            if($lang=='ar'){
                $title = $request->title_ar;
                $body = $request->description_ar;
            }else{
                $title = $request->title_en;
                $body = $request->description_en;
            }
            $this->sendFCMNotification([$id],$title,$body,$request->type);
        }

        return $this->apiResponse(route('notifications'),'success','simple');
    }

    public function delete(Request $request){
        Notification::find($request->id)->delete();
        return $this->apiResponse('delete','success','simple');
    }
}
