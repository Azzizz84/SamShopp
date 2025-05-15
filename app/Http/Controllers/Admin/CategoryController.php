<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\AddCityRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use PaginateTrait,ImageTrait;
    public function index(){
        $categories = Category::all();
        $categories->each->makeVisible('*');
        return view('admin.pages.category.categories',compact('categories'));
    }
    public function add(){
        return view('admin.pages.category.add_category');
    }
    public function store(AddCityRequest $request){
        $category = Category::create($request->all());
        if($request->hasFile('image')){
            $category = Category::find($category->id);
            $image = $this->addImage($request->image,'categories');
            $category->image = $image;
            $category->save();
        }
        return $this->apiResponse(route('categories'),'success','simple');
    }
    public function edit($id){
        $category = Category::find($id);
        return view('admin.pages.category.add_category',compact('category'));
    }
    public function update(AddCityRequest $request){
        $data = $request->except('image');
        Category::find($request->id)->update($data);
        if($request->hasFile('image')){
            $category = Category::find($request->id);
            $category->deleteModelImage();
            $image = $this->addImage($request->image,'categories');
            $category->image = $image;
            $category->save();
        }
        return $this->apiResponse(route('categories'),'success','simple');
    }
    public function delete(Request $request){
        $category = Category::find($request->id);
        $category->delete();
        return $this->apiResponse('delete','success','simple');
    }
}
