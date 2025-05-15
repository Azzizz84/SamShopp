<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use PaginateTrait;
    public  function get_settings(){
        $data = Setting::first();
        return $this->apiResponse($data,'success','simple');
    }
}
