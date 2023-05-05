<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Repositories\UserId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{

    /*
    userId variable
     */
    public $userId;

    public function __construct(UserId $userId)
    {

        $this->userId = $userId;

    }

    public function createLesson(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenBaiHoc' => 'required',
            'linkVideo' => 'required',
            'tenBaiTap' => 'required',
            'moTaBaiTap' => 'required',
        ], [
            'tenBaiHoc.required' => 'Tên bài học không được để trống',
            'linkVideo.required' => 'Video không được để trống',
            'tenBaiTap.required' => 'Tên bài tập không được để trống',
            'moTaBaiTap.required' => 'Mô tả bài tập không được để trống',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $createLesson = Lesson::create([
            'tenBaiHoc' => $request->tenBaiHoc,
            'linkVideo' => $request->linkVideo,
            'tenBaiTap' => $request->tenBaiTap,
            'moTaBaiTap' => $request->moTaBaiTap,
            'trangThai' => $request->trangThai,
            'chapter_id' => $request->chapter_id,
            'user_id' => $this->userId->returnUserId(),

        ]);

        return response()->json(['message' => 'Đăng bài học thành công', 'data' => $createLesson], 200);
    }
}
