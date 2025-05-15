<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\AddCityRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use PaginateTrait,ImageTrait;
    public function index(){
        $banners = Banner::all();
        return view('admin.pages.banner.banners',compact('banners'));
    }
    public function add(){
        return view('admin.pages.banner.add_banner');
    }

    public function store(Request $request){
        $banner = Banner::create($request->all());
        if($request->hasFile('image')){
            $image = $this->addImage($request->image,'banners');
            $banner->image = $image;
            $banner->save();
        }
        return $this->apiResponse(route('banners'),'success','simple');
    }

    public function delete(Request $request){
        $banner = Banner::find($request->id);
        $banner->deleteModelImage();
        $banner->delete();
        return $this->apiResponse('delete','success','simple');
    }
}
