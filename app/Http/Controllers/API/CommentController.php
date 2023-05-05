<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Repositories\UserId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    /*
    userId variable
     */
    public $userId;

    public function __construct(UserId $userId)
    {

        $this->userId = $userId;

    }

    public function createComment(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'noiDung' => 'required',
        ], [
            'noiDung.required' => 'Nội dung không được trống',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $comment = new Comment();
        $comment->noiDung = $request->noiDung;
        $comment->user_id = $this->userId->returnUserId();
        $comment->lesson_id = $id;

        if ($request->input('parent_id')) {
            $comment->parent_id = $request->input('parent_id');
        }

        $comment->save();

        return response()->json($comment);
    }
}
