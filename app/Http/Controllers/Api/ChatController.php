<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Chat\CreateMessageRequest;
use App\Http\Requests\Api\Chat\GetServiceOrderChatRequest;
use App\Http\Traits\NotificationTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Chat;
use App\Models\Message;
use App\Models\ServiceOrder;
use App\Models\ServiceProvider;
use App\Models\User;
use Carbon\Carbon;

class ChatController extends Controller
{
    use PaginateTrait,NotificationTrait;
    public function get_service_order_chat(GetServiceOrderChatRequest $request){
        $order = ServiceOrder::find($request->id);
        $chat = $order->chat;
        if(!$chat){
            $data['service_order_id'] = $order->id;
            $data['user_id'] = $order->user_id;
            $data['service_provider_id'] = $order->accepted_offer->service_provider_id;
            $order->chat()->create($data);
        }
        $chat = $order->chat()->with('messages')->first();
        return $this->apiResponse($chat,'success','simple');
    }
    public function create_message(CreateMessageRequest $request){
        $chat = Chat::find($request->chat_id);
        $message = $chat->messages()->create($request->all());
        $message = Message::find($message->id);
        $createdAtInRiyadh = Carbon::parse($message->created_at)->format('Y-m-d\TH:i:s.u\Z');
        $message->created_at = $createdAtInRiyadh;
        $message->chat = $chat;
        $body = $request->message;
        if($request->from=="service_provider"){
            $lang = User::find($message->chat->user_id)->lang;
            $token = [$message->chat->user_id];
            $type = "user";
        }else{
            $lang = ServiceProvider::find($message->chat->service_provider_id)->lang;
            $token = [$message->chat->service_provider_id];
            $type = "service_provider";
        }
        app()->setLocale($lang);
        $title = __('notification.new_order_message').$message->chat->order_id;
        $this->sendFCMNotification($token,$title,$body,$type,
            $message,'chat');
        return $this->apiResponse($message,'success','simple');
    }
}
