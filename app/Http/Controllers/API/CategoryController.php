<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    protected function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'tenDanhMuc' => [
                'required',
                'string',
                Rule::unique('categories'),
            ],
            'moTa' => 'required|max:255',
        ], [
            'tenDanhMuc.required' => 'Tên danh mục không được để trống',
            'tenDanhMuc.unique' => 'Tên danh mục đã tồn tại',
            'moTa.required' => 'Mô tả không được để trống',
        ]);
    }

    protected function validatorUpdateCategory(Request $request, $id = null)
    {
        return Validator::make($request->all(), [
            'tenDanhMuc' => [
                'required',
                'string',
                Rule::unique('categories')->ignore($id),
            ],
            'moTa' => 'required|max:255',
        ], [
            'tenDanhMuc.required' => 'Tên danh mục không được để trống',
            'tenDanhMuc.unique' => 'Tên danh mục đã tồn tại',
            'moTa.required' => 'Mô tả không được để trống',
        ]);
    }

    protected function validatorCourse(Request $request)
    {

        return Validator::make($request->all(), [

            'tenKhoaHoc' => 'required',
            'moTa' => 'required',
            'linkVideo' => 'required',
            'giaCa' => 'required|numeric',
        ], [
            'tenKhoaHoc.required' => 'Tên khóa học không được để trống',
            'moTa.required' => 'Mô tả không được để trống',
            'linkVideo.required' => 'Link video không được để trống',
            'giaCa.required' => 'Gía cả không được để trống',
            'giaCa.numeric' => 'Gía cả phải là số',

        ]);
    }

    public function createCategory(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::guard('api')->user();
        $createCategory = Category::create([
            'idGiangVien' => $user->id,
            'tenDanhMuc' => $request->tenDanhMuc,
            'moTa' => $request->moTa,
        ]);

        return response()->json(['message' => 'Tạo danh mục thành công'], 200);

    }

    public function getCategory()
    {
        $user = Auth::guard('api')->user();
        $userId = $user->id;
        $categories = Category::where('idGiangVien', $userId)->get();
        return response()->json(['data' => $categories], 200);
    }

    public function getCategories()
    {
        $categories = Category::all();
        return response()->json(['data' => $categories], 200);
    }

    public function createCourse(Request $request)
    {
        $validator = $this->validatorCourse($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::guard('api')->user();
        $userId = $user->id;
        $createCourse = Course::create([

            'tenKhoaHoc' => $request->tenKhoaHoc,
            'moTa' => $request->moTa,
            'linkVideo' => $request->linkVideo,
            'giaCa' => $request->giaCa,
            'trangThai' => 0,
            'category_id' => $request->category_id,
            'idGiangVien' => $userId,
        ]);

        return response()->json(['message' => 'Đăng khóa học thành công!'], 200);

    }

    public function getCourse()
    {
        $user = Auth::guard('api')->user();
        $userId = $user->id;

        $course = Course::where('idGiangVien', '=', $userId)->get();

        return response()->json(['data' => $course]);

    }

    public function getCoursesShow()
    {
        $courses = Course::all();

        return response()->json(['data' => $courses]);

    }

    public function getCoursesByTeacherId($id)
    {
        $user = User::find($id);
        $courses = Course::where('idGiangVien', $id)->get();

        return response()->json(['user' => $user, 'data' => $courses]);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $user = Auth::guard('api')->user();

        if ($category->idGiangVien !== $user->id) {
            return response()->json(['message' => 'Bạn không có quyền cập nhật danh mục này'], 422);
        }

        $validator = $this->validatorUpdateCategory($request, $id);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $category->update([
            'tenDanhMuc' => $request->tenDanhMuc,
            'moTa' => $request->moTa,
        ]);

        return response()->json(['message' => 'Cập nhật danh mục thành công'], 200);
    }

    public function updateCourse(Request $request, $id)
    {
        $validator = $this->validatorCourse($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = Auth::guard('api')->user();
        $userId = $user->id;

        $course = Course::where('id', $id)
            ->where('idGiangVien', $userId)
            ->first();

        if (!$course) {
            return response()->json(['message' => 'Không tìm thấy khóa học'], 422);
        }

        $course->update([
            'tenKhoaHoc' => $request->tenKhoaHoc,
            'moTa' => $request->moTa,
            'linkVideo' => $request->linkVideo,
            'giaCa' => $request->giaCa,
            'category_id' => $request->category_id,
        ]);

        $course = $course->fresh();

        return response()->json(['message' => 'Cập nhật khóa học thành công', 'data' => $course], 200);
    }

}
