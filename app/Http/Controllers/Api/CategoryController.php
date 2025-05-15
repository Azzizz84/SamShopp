<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use PaginateTrait;

    public function get_categories(Request $request){
        $data = Category::query();
        if(isset($request->search)){
            $data = $data->where('name_ar','like','%'.$request->search.'%')
                ->orWhere('name_en','like','%'.$request->search.'%');
        }
        return $this->apiResponse($data);
    }
}
