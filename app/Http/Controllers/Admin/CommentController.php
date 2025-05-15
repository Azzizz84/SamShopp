<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Comment;
use App\Models\Market;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use PaginateTrait;
    public function index($id){
        $market = Market::find($id);
        return view('admin.pages.markets.rate',compact('market'));
    }

    public function delete(Request $request){
        Comment::find($request->id)->delete();
        return $this->apiResponse('delete','success','simple');
    }
}
