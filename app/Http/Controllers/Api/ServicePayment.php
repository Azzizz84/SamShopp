<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Setting;
use App\Models\Verify;
use Illuminate\Http\Request;

class ServicePayment extends Controller
{
    use ImageTrait,PaginateTrait;


    public function payment_mywallet($total,$type){
        $data['total'] = $total;
        $data['user_id'] = service_provider_api()->id;
        $data['type'] = $type;
        return view('payment',compact('data'));
    }

}
