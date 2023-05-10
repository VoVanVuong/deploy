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

        return response()->json(['message' => 'Bình luận thành công', 'data' => $comment]);
    }

    public function createReply(Request $request, $id, $commentId)
    {
        $validator = Validator::make($request->all(), [
            'noiDung' => 'required',
        ], [
            'noiDung.required' => 'Nội dung không được trống',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $comment = Comment::findOrFail($commentId);

        $reply = new Comment();
        $reply->noiDung = $request->noiDung;
        $reply->user_id = $this->userId->returnUserId();
        $reply->lesson_id = $id;
        $reply->parent_id = $commentId;

        $reply->save();

        return response()->json(['message' => 'Trả lời bình luận thành công', 'data' => $reply]);

    }

    public function getComments($id)
    {
        $comments = Comment::where('lesson_id', $id)
            ->whereNull('parent_id')
            ->with('user')
            ->with('replies.user')
            ->get();

        return response()->json(['data' => $comments]);
    }

}
