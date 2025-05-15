<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\AddCityRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    use PaginateTrait,ImageTrait;
    public function index($id){
        $category = Category::find($id);
        $category->makeVisible('*');
        return view('admin.pages.sub_category.sub_categories',compact('category'));
    }
    public function add($id){
        $category = Category::find($id);
        $category->makeVisible('*');
        return view('admin.pages.sub_category.add_sub_category',compact('category'));
    }
    public function store(AddCityRequest $request){
        $category = SubCategory::create($request->all());
        if($request->hasFile('image')){
            $category = SubCategory::find($category->id);
            $image = $this->addImage($request->image,'sub_categories');
            $category->image = $image;
            $category->save();
        }
        return $this->apiResponse(route('sub_categories',['categoryId'=>$request->category_id]),'success','simple');
    }
    public function edit($id,$subCategory){
        $category = Category::find($id);
        $sub_category = SubCategory::find($subCategory);
        return view('admin.pages.sub_category.add_sub_category',compact('category','sub_category'));
    }
    public function update(AddCityRequest $request){
        $data = $request->except('image');
        SubCategory::find($request->id)->update($data);
        if($request->hasFile('image')){
            $category = SubCategory::find($request->id);
            $category->deleteModelImage();
            $image = $this->addImage($request->image,'sub_categories');
            $category->image = $image;
            $category->save();
        }
        return $this->apiResponse(route('sub_categories',['categoryId'=>$request->category_id]),'success','simple');
    }
    public function delete(Request $request){
        $category = SubCategory::find($request->id);
        $category->delete();
        return $this->apiResponse('delete','success','simple');
    }
}
