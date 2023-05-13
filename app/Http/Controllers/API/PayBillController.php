<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Course;
use App\Models\MyChapter;
use App\Models\MyCourse;
use App\Models\MyLesson;
use App\Repositories\UserId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PayBillController extends Controller
{

    /*
    userId variable
     */
    public $userId;
    protected $activationCode;
    protected $invoiceNumber;
    protected $currentTimeNow;

    public function __construct(UserId $userId)
    {

        $this->userId = $userId;
        $this->activationCode = Str::random(10, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $this->invoiceNumber = 'INV-' . Str::random(10);
        // $this->currentTimeNow = Carbon::now()->setTimezone('Asia/Ho_Chi_Minh');

    }
    /*
    validator bill
     */
    protected function validatorCreateBill(Request $request)
    {
        return Validator::make($request->all(), [
            'hoTen' => 'required',
            'soDienThoai' => 'required|numeric',
            'diaChi' => 'required',
        ], [

            'hoTen.required' => 'Họ tên không được để trống',
            'soDienThoai.required' => 'Số điện thoại không được để trống',
            'soDienThoai.numeric' => 'Số điện thoại phải là số',
            'diaChi.required' => 'Địa chỉ không được để trống',
        ]);
    }

    /*
    Pay bills
     */
    public function createPayBills(Request $request, $id)
    {
        $validator = $this->validatorCreateBill($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $course = $this->getCoursePayBill($id);

        $course->instructor;

        $myCourse = $this->createMyCourse($course);

        $this->createMyChapter($myCourse->id, $course->chapters);

        $this->createBill($request, $myCourse->id);

        return response()->json(['message' => 'Mua khóa học thành công'], 200);

    }

    /*
    get my course login
     */
    public function getMyCourse()
    {
        $myCourses = MyCourse::where('user_id', $this->userId->returnUserId())->get();

        if ($myCourses->isEmpty()) {
            return response()->json(['error' => 'Bạn chưa mua khóa học'], 422);
        }

        $courses = [];

        foreach ($myCourses as $course) {
            $getMyCourse = $course->with(['myChapter' => function ($query) {
                $query->select(['id', 'tenChuongHoc', 'trangThai', 'giaoVienID', 'my_course_id'])
                    ->with('myLessons');
            }])->findOrFail($course->id);

            $courses[] = $getMyCourse;
        }

        return response()->json(['data' => $courses]);
    }

    /*
    post Activation Code
     */
    public function postActivationCode(Request $request, $id)
    {
        $myCourse = MyCourse::where('id', $id)
            ->where('user_id', $this->userId->returnUserId())
            ->first();
        $activationCode = $request->input('activation_code');
        if ($myCourse->trangThai == 0) {
            return response()->json(['error' => 'Khóa học đã được kích hoạt'], 422);
        }
        if ($activationCode && $activationCode === $myCourse->maKichHoat) {
            $myCourse->trangThai = 0;
            $myCourse->save();
            return response()->json(['message' => 'Kích hoạt mã thành công'], 200);
        }
        return response()->json(['error' => 'Mã kích hoạt không chính xác'], 422);

    }

    protected function getCoursePayBill($id)
    {
        return Course::with(['chapters' => function ($query) {
            $query->select(['id', 'tenChuongHoc', 'course_id', 'user_id', 'trangThai'])
                ->with('lessons');
        }])->findOrFail($id);
    }

    /*
    create my course
     */
    protected function createMyCourse($course)
    {

        return MyCourse::create([
            'tenKhoaHoc' => $course->tenKhoaHoc,
            'moTa' => $course->moTa,
            'linkVideo' => $course->linkVideo,
            'giaCa' => $course->giaCa,
            'trangThai' => 1,
            'giaoVienID' => $course->instructor->id,
            'maHoaDon' => $this->invoiceNumber,
            'maKichHoat' => $this->activationCode,
            'ngayHetHan' => null,
            'ngayMua' => now(),
            'user_id' => $this->userId->returnUserId(),
        ]);
    }

    /*
    create my chapter
     */
    protected function createMyChapter($myCourseId, $chapters)
    {
        $myChapters = [];

        foreach ($chapters as $chapter) {
            $myChapter = MyChapter::create([
                'tenChuongHoc' => $chapter->tenChuongHoc,
                'trangThai' => $chapter->trangThai,
                'giaoVienID' => $chapter->user_id,
                'my_course_id' => $myCourseId,
            ]);

            foreach ($chapter->lessons as $lesson) {
                MyLesson::create([
                    'tenBaiHoc' => $lesson->tenBaiHoc,
                    'linkVideo' => $lesson->linkVideo,
                    'tenBaiTap' => $lesson->tenBaiTap,
                    'moTaBaiTap' => $lesson->moTaBaiTap,
                    'trangThai' => $lesson->trangThai,
                    'giaoVienID' => $lesson->user_id,
                    'my_chapter_id' => $myChapter->id,
                ]);
            }

            $myChapters[] = $myChapter;
        }
    }

    /*
    create bill
     */
    protected function createBill(Request $request, $myCourseId)
    {
        return Bill::create([
            'hoTen' => $request->hoTen,
            'soDienThoai' => $request->soDienThoai,
            'diaChi' => $request->diaChi,
            'maHoaDon' => $this->invoiceNumber,
            'maKichHoat' => $this->activationCode,
            'user_id' => $this->userId->returnUserId(),
            'my_course_id' => $myCourseId,
        ]);
    }

}
