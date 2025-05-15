<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Comment\CreateCommentRequest;
use App\Http\Requests\Api\Comment\GetCommentRequest;
use App\Http\Traits\PaginateTrait;
use App\Models\Comment;
use App\Models\Market;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use PaginateTrait;
    public function create_comment(CreateCommentRequest $request){
        $data = $request->all();
        $data['user_id'] = userApi()->id;
        $comment = Comment::create($data);
        $comment = Comment::where('id',$comment->id)->with(['user'=>function ($query) {
            $query->select('id','name');
        },])->first();
        return $this->apiResponse($comment,'success','simple');
    }

    public function get_comment(GetCommentRequest $request){
        $comments = Market::find($request->market_id)->comments()->with(['user'=>function($query){
            $query->select('id','name',);
        }]);
        return $this->apiResponse($comments);
    }
}
