<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Evaluate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EvaluateController extends Controller
{

    /*
    course assessment
     */
    public function createEvaluate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'soSaoDanhGia' => 'required|numeric',

        ], [
            'soSaoDanhGia.required' => 'Số sao không được để trống',
            'soSaoDanhGia.numeric' => 'Số sao phải là số',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $course = Course::findOrFail($id);
        $numberOfEvaluates = $course->evaluates()->count();
        $user = Auth::guard('api')->user();
        $userId = $user->id;

        $existingEvaluate = Evaluate::where('idNguoiDung', $userId)
            ->where('idKhoaHoc', $course->id)
            ->first();

        if ($existingEvaluate) {
            return response()->json(['message' => 'Bạn đã đánh giá khóa học này rồi'], 422);
        }

        $createEvaluate = Evaluate::create([
            'soSaoDanhGia' => $request->soSaoDanhGia,
            'idNguoiDung' => $userId,
            'idKhoaHoc' => $course->id,
        ]);

        return response()->json([
            'message' => 'Đánh giá thành công',
        ], 200);

    }
    /*
    get all users and reviews of a course
     */
    public function getEvaluate($id)
    {

        $users = User::with('reviews.course')->whereHas('reviews', function ($query) use ($id) {
            $query->where('idKhoaHoc', $id);
        })->get();
        $totalEvaluate = Evaluate::where('idKhoaHoc', $id)->count();

        return response()->json(['data' => $users, 'totalEvaluate' => $totalEvaluate]);
    }
}
