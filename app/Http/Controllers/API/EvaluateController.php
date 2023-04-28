<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class EvaluateController extends Controller
{

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
        $user = Auth::guard('api')->user();
        $userId = $user->id;

        $createEvaluate = Evaluate::create([
            'soSaoDanhGia' => $request->soSaoDanhGia,
            'idNguoiDung' => $userId,
            'idKhoaHoc' => $course->id,
        ]);

        return response()->json(['message' => 'Đánh giá thành công'], 200);

    }
    /*
    get all users and reviews of a course
     */
    public function getEvaluate($id)
    {
        // $evaluates = Evaluate::where('idKhoaHoc', $id)->with('user')->get();
        $users = User::with('reviews.course')->whereHas('reviews', function ($query) use ($id) {
            $query->where('idKhoaHoc', $id);
        })->get();
        // $userReviews = User::whereHas('reviews', function ($query) use ($id) {
        //     $query->where('idNguoiDung', $id);
        // })->with('courses')->get();

        return json_encode($users);
    }
}
