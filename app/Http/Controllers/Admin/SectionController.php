<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Http\Traits\PaginateTrait;
use App\Models\Market;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    use PaginateTrait,ImageTrait;
    public function index($id){
        $market = Market::where('id',$id)->first();
        return view('admin.pages.section.sections',compact('market'));
    }

    public function delete(Request $request){
        Section::find($request->id)->delete();
        return $this->apiResponse('delete','success','simple');
    }
}
