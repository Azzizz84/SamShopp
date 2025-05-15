<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\GetSubCategoryRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    use PaginateTrait;

    public function get_sub_category(GetSubCategoryRequest $request){
        $data = Category::find($request->id)->subCategories();
        return $this->apiResponse($data);
    }
}
