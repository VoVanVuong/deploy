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

    protected function validatorUpdateLesson(Request $request)
    {
        return Validator::make($request->all(), [
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

    public function updateLesson(Request $request, $id)
    {
        $validator = $this->validatorUpdateLesson($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $lesson = Lesson::where('id', $id)
            ->where('user_id', $this->userId->returnUserId())
            ->first();

        if (!$lesson) {
            return response()->json(['error' => 'Bạn không có quyền'], 422);
        }

        $lesson->update([
            'tenBaiHoc' => $request->tenBaiHoc,
            'linkVideo' => $request->linkVideo,
            'tenBaiTap' => $request->tenBaiTap,
            'moTaBaiTap' => $request->moTaBaiTap,
            'trangThai' => $request->trangThai,
            'chapter_id' => $request->chapter_id,
            'user_id' => $this->userId->returnUserId(),
        ]);

        return response()->json(['message' => 'Cập nhật bài học thành công', 'data' => $lesson->fresh()], 200);
    }

    public function deleteLesson($id)
    {
        $lesson = Lesson::find($id);

        if ($lesson && $lesson->user_id == $this->userId->returnUserId()) {
            $lesson->delete();
            return response()->json(['message' => 'Xóa bài học thành công'], 200);
        }

        return response()->json(['error' => 'Bạn không có quyền xóa'], 422);
    }
}
