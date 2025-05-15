<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    use PaginateTrait;
    public function get_notification(Request $request){
        $data = Notification::where('type',$request->type);
        return $this->apiResponse($data);
    }
}
