<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\AddCityRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\AppService;
use App\Models\Category;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use PaginateTrait,ImageTrait;
    public function index(){
        $services = AppService::all();
        $services->each->makeVisible('*');
        return view('admin.pages.service.service',compact('services'));
    }
    public function add(){
        $categories  = Category::all();
        return view('admin.pages.service.add_service',compact('categories'));
    }

    public function service_details($id)
    {
        $services = AppService::where('id',$id)->get();
        $services->each->makeVisible('*');
        return view('admin.pages.service.service',compact('services'));
    }
    public function get_sub_categories(Request $request)
    {
        $data = Category::find($request->id)->subCategories;
        return $this->apiResponse($data,'success','simple');
    }
    public function store(Request $request){
        $data = $request->all();
//        if(!is_int($request->category_id)){
//            $data['category_id'] = null;
//        }
//        if(!is_int($request->sub_category_id)){
//            $data['sub_category_id'] = null;
//        }
        $data = AppService::create($data);
        if($request->hasFile('image')){
            $data = AppService::find($data->id);
            $image = $this->addImage($request->image,'service');
            $data->image = $image;
            $data->save();
        }
        return $this->apiResponse(route('services'),'success','simple');
    }
    public function edit($id){
        $service = AppService::find($id);
        $categories  = Category::all();
        return view('admin.pages.service.add_service',compact('service','categories'));
    }
    public function update(Request $request){
        $data = $request->except('image');
//        if(!is_int($request->category_id)){
//            $data['category_id'] = null;
//        }
//        if(!is_int($request->sub_category_id)){
//            $data['sub_category_id'] = null;
//        }
        AppService::find($request->id)->update($data);
        if($request->hasFile('image')){
            $service = AppService::find($request->id);
            $image = $this->addImage($request->image,'service',$service->image);
            $service->image = $image;
            $service->save();
        }
        return $this->apiResponse(route('services'),'success','simple');
    }
    public function delete(Request $request){
        $data = AppService::find($request->id);
        $data->delete();
        return $this->apiResponse('delete','success','simple');
    }
}
