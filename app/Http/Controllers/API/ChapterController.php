<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Repositories\UserId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChapterController extends Controller
{
    /*
    userId variable
     */
    public $userId;

    public function __construct(UserId $userId)
    {

        $this->userId = $userId;

    }

    /*
    validator update chapter
     */
    protected function validatorUpdateChapter(Request $request)
    {
        return Validator::make($request->all(), [
            'tenChuongHoc' => 'required|unique:chapters,tenChuongHoc,' . $request->id . ',id,user_id,' . Auth::guard('api')->user()->id,
        ], [
            'tenChuongHoc.required' => 'Tên chương học không bỏ trống',
            'tenChuongHoc.unique' => 'Tên chương học đã tồn tại',
        ]);
    }
    /*
    create chapter
     */
    public function createChapter(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tenChuongHoc' => 'required',
        ], [
            'tenChuongHoc.required' => 'Tên chương học không được bỏ trống',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $createChapter = Chapter::create([
            'tenChuongHoc' => $request->tenChuongHoc,
            'trangThai' => $request->trangThai,
            'course_id' => $request->course_id,
            'user_id' => $this->userId->returnUserId(),
        ]);

        return response()->json(['message' => 'Đăng chương học thành công', 'data' => $createChapter], 200);
    }

    /*
    get chapter teacher
     */
    public function getChapter($id)
    {
        $getChapter = Chapter::where('course_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        return response()->json(['data' => $getChapter]);
    }

    /*
    update chapter teacher
     */
    public function updateChapterTeacher(Request $request, $id)
    {
        $validator = $this->validatorUpdateChapter($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $chapter = Chapter::where('id', $id)
            ->where('user_id', $this->userId->returnUserId())
            ->first();

        $chapter->update([
            'tenChuongHoc' => $request->tenChuongHoc,
            'trangThai' => $request->trangThai,
            'course_id' => $request->course_id,
            'user_id' => $this->userId->returnUserId(),
        ]);

        return response()->json(['message' => 'Cập nhật chương học thành công', 'data' => $chapter->fresh()], 200);
    }

}
