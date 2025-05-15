<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use PaginateTrait;
    public function get_banners(){
        $data = Banner::query();
        return $this->apiResponse($data);
    }
}
