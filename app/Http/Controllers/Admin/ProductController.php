<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Market;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    use PaginateTrait,ImageTrait;
    public function index($id,$sectionId){
        $market = Market::where('id',$id)->first();
        $section = Section::where('market_id',$market->id)->where('id',$sectionId)->first();
        return view('admin.pages.product.products',compact('market','section'));
    }
    public function delete(Request $request){
        Product::find($request->id)->delete();
        return $this->apiResponse('delete','success','simple');
    }
}
