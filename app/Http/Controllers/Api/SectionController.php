<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Section\CreateSectionRequest;
use App\Http\Requests\Api\Section\DeleteSectionRequest;
use App\Http\Requests\Api\Section\UpdateSectionRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    use PaginateTrait,ImageTrait;

    public function get_menu(){
        $data = market_api()->sections()->with('products');
        return $this->apiResponse($data);
    }

    public function create_section(CreateSectionRequest $request){
        $data = market_api()->sections()->create([
            'title'=>$request->title,
        ]);
        if($request->hasFile('image')){
            $image = $this->addImage($request->image,'sections');
            $data->image = $image;
            $data->save();
        }
        return $this->apiResponse($data,'success','simple');
    }
    public function update_section(UpdateSectionRequest $request){
        $section = market_api()->sections()->find($request->id);
        $data = $request->except('image');
        $section->update($data);
        if($request->hasFile('image')){
            $data = market_api()->sections()->find($request->id);
            if($data->image){
                $data->deleteModelImage();
            }
            $image = $this->addImage($request->image,'sections');
            $data->image = $image;
            $data->save();
        }
        $data = market_api()->sections()->where('id',$request->id)->with('products')->first();
        return $this->apiResponse($data,'success','simple');
    }

    public function delete_section(DeleteSectionRequest $request){
        $data = market_api()->sections()->find($request->id);
        if($data){
            $data->delete();
        }
        return $this->apiResponse('success','success','simple');
    }
}
