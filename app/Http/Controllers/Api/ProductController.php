<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\CreateProductRequest;
use App\Http\Requests\Api\Product\DeleteProductRequest;
use App\Http\Requests\Api\Product\UpdateProductRequest;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use PaginateTrait,ImageTrait;

    public function create_product(CreateProductRequest $request){
        $data = $request->all();
        $data = Product::create($data);
        if($request->hasFile('image')){
            $image = $this->addImage($request->image,'products');
            $data->image = $image;
            $data->save();
        }
        $data = Product::find($data->id);
        return $this->apiResponse($data,'success','simple');
    }
    public function update_product(UpdateProductRequest $request){
        $data = $request->except('image');
        $data['offer_price'] = $request->offer_price;
        Product::find($request->id)->update($data);
        if($request->hasFile('image')){
            $data = Product::find($request->id);
            if($data->image){
                $data->deleteModelImage();
            }
            $image = $this->addImage($request->image,'products');
            $data->image = $image;
            $data->save();
        }
        $data = Product::find($request->id);
        return $this->apiResponse($data,'success','simple');
    }

    public function delete_product(DeleteProductRequest $request){
        $data = Product::find($request->id);
        if($data){
            $data->delete();
        }
        return $this->apiResponse('success','success','simple');
    }
}
