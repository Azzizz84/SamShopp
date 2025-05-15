<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use PaginateTrait;

    public function get_cities(Request $request){
        $data = City::query();
        return $this->apiResponse($data);
    }
}
