<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
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
        $validator = Validator::make($request->all(), [

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
            'trangThai' => $request->trangThai,
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
        $courses = Course::where('idGiangVien', $id)->get();

        return response()->json(['data' => $courses]);
    }

    protected function validator($request)
    {

        return Validator::make($request->all(), [

            'tenDanhMuc' => 'required',
            'moTa' => 'required',

        ], [

            'tenDanhMuc.required' => 'Tên danh mục không để trống',
            'moTa.required' => 'Mô tả không để trống',

        ]);
    }
}
