<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use App\Repositories\UserId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
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
    validator
     */
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

    /*
    validator update category
     */
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

    /*
    validator course
     */
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

    /*
    create category
     */
    public function createCategory(Request $request)
    {
        $validator = $this->validator($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $createCategory = Category::create([
            'idGiangVien' => $this->userId->returnUserId(),
            'tenDanhMuc' => $request->tenDanhMuc,
            'moTa' => $request->moTa,
        ]);

        return response()->json(['message' => 'Tạo danh mục thành công', 'data' => $createCategory], 200);

    }

    /*
    get category
     */
    public function getCategory()
    {
        $categories = Category::where('idGiangVien', $this->userId->returnUserId())
            ->orderBy('id', 'desc')
            ->get();
        return response()->json(['data' => $categories], 200);
    }

    /*
    get categories
     */
    public function getCategories()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return response()->json(['data' => $categories], 200);
    }

    /*
    create course
     */
    public function createCourse(Request $request)
    {
        $validator = $this->validatorCourse($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $createCourse = Course::create([

            'tenKhoaHoc' => $request->tenKhoaHoc,
            'moTa' => $request->moTa,
            'linkVideo' => $request->linkVideo,
            'giaCa' => $request->giaCa,
            'trangThai' => 0,
            'category_id' => $request->category_id,
            'user_id' => $this->userId->returnUserId(),
        ]);

        return response()->json(['message' => 'Đăng khóa học thành công', 'data' => $createCourse], 200);

    }

    /*
    get course
     */
    public function getCourse()
    {
        $course = Course::where('user_id', '=', $this->userId->returnUserId())
            ->orderBy('id', 'desc')
            ->get();

        return response()->json(['data' => $course]);

    }

    /*
    get courses
     */
    public function getCoursesShow()
    {
        $courses = Course::orderBy('id', 'desc')->get();

        return response()->json(['data' => $courses]);

    }

    public function getDetailCourse($id)
    {

        $course = Course::with(['chapters' => function ($query) {
            $query->select(['id', 'tenChuongHoc', 'course_id', 'user_id'])
                ->with('lessons');
        }])->findOrFail($id);

        $course->instructor;

        return response()->json(['data' => $course]);
    }
    /*
    get courses teacher
     */
    public function getCoursesByTeacherId($id)
    {
        $user = User::find($id);
        $courses = Course::where('user_id', $id)->orderBy('id', 'desc')->get();

        return response()->json(['user' => $user, 'data' => $courses]);
    }

    /*
    update category
     */
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        if ($category->idGiangVien !== $this->userId->returnUserId()) {
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

        return response()->json(['message' => 'Cập nhật danh mục thành công', 'data' => $category->fresh()], 200);
    }

    public function deleteCourse($id)
    {
        $course = Course::find($id);

        if ($course && $course->user_id == $this->userId->returnUserId()) {
            $course->delete();
            return response()->json(['message' => 'Xóa khóa học thành công'], 200);
        }
        return response()->json(['error' => 'Bạn không có quyền xóa '], 422);

    }

    /*
    update course teacher
     */
    public function updateCourse(Request $request, $id)
    {
        $validator = $this->validatorCourse($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $course = Course::where('id', $id)
            ->where('user_id', $this->userId->returnUserId())
            ->first();

        if (!$course) {
            return response()->json(['message' => 'Không tìm thấy khóa học'], 422);
        }

        $course->update([
            'tenKhoaHoc' => $request->tenKhoaHoc,
            'moTa' => $request->moTa,
            'linkVideo' => $request->linkVideo,
            'giaCa' => $request->giaCa,
            'trangThai' => $request->trangThai,
            'category_id' => $request->category_id,
        ]);

        return response()->json(['message' => 'Cập nhật khóa học thành công', 'data' => $course->fresh()], 200);
    }

}
