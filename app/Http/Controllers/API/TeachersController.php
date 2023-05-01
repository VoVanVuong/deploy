<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Storage;

class TeachersController extends Controller
{
    protected function validatorUpdateUser(Request $request)
    {
        $input = $request->only('hoTen', 'password', 'soDienThoai', 'ngaySinh', 'diaChi', 'avatar', 'trangThai', 'phanQuyen');
        $rules = [
            'hoTen' => 'required',
            'ngaySinh' => 'required|date',
            'diaChi' => 'required',
            'avatar' => 'image',
            'gioiTinh' => 'nullable',
        ];

        if (isset($input['soDienThoai'])) {
            $rules['soDienThoai'] = 'required|numeric|unique:users,soDienThoai,' . Auth::guard('api')->user()->id;
        }

        return Validator::make($input, $rules, [
            'hoTen.required' => 'Tên không được để trống',
            'soDienThoai.required' => 'Số điện thoại không được để trống',
            'soDienThoai.unique' => 'Số điện thoại đã được đăng kí',
            'soDienThoai.numeric' => 'Số điện thoại phải là số',
            'avatar.image' => 'Hình ảnh phải đúng định dạng',
            'diaChi.required' => 'Địa chỉ không được để trống',
            'ngaySinh.required' => 'Ngày sinh không được để trống',
            'ngaySinh.date' => 'Ngày sinh phải đúng định dạng',
        ]);
    }
    public function getTeachers()
    {
        $teachers = User::where('phanQuyen', 2)->get();

        return response()->json($teachers);
    }

    public function getACourse($id)
    {
        $teacher = User::find($id);
        $courses = Course::where('idGiangVien', $teacher->id)->get();

        return response()->json(['data' => $courses]);

    }

    public function updateUserProfile(Request $request)
    {

        $validator = $this->validatorUpdateUser($request);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $email = $request->input('email');

        $user = Auth::guard('api')->user();

        if ($email && $email !== $user->email) {
            return response()->json(['message' => 'Bạn không thể cập nhập lại gmail'], 422);
        }

        if (!$user) {
            return response()->json(['error' => 'Profile này không phải của bạn'], 422);
        }

        $userData = [
            'soDienThoai' => $request->soDienThoai,
            'hoTen' => $request->hoTen,
            'ngaySinh' => $request->ngaySinh,
            'diaChi' => $request->diaChi,
            'avatar' => $user->avatar,
        ];

        if ($request->has('avatar')) {
            $image = $request->file('avatar');
            $path = Storage::disk('google')->putFileAs('/', $image, $image->getClientOriginalName());
            $url = Storage::disk('google')->url($path);
            $userData['avatar'] = $url;
        }

        if ($request->has('gioiTinh')) {
            $userData['gioiTinh'] = $request->gioiTinh;
        }

        $user->update($userData);

        $user = $user->fresh();
        return response()->json(['message' => 'Cập nhật profile thành công', 'data' => $user], 200);
    }

    public function changePassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|max:20|min:6',
            'confirm_password' => 'required|same:new_password',
        ], [
            'old_password.required' => 'Mật khẩu không được để trống',
            'new_password.required' => 'Mật khẩu mới không được để trống',
            'new_password.min' => 'Mật khẩu phải lớn hơn 6 kí tự',
            'confirm_password.required' => 'Lặp lại mật khẩu không được để trống',
            'confirm_password.same' => 'Không trùng với mật khẩu mới',

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user = Auth::guard('api')->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json(['error' => 'Mật khẩu cũ không đúng'], 422);
        }

        if (strcmp($request->old_password, $request->new_password) == 0) {
            return response()->json(['error' => 'Mật khẩu mới giống mật khẩu cũ'], 422);
        }

        $user->password = Hash::make($request['new_password']);
        $user->save();

        return response()->json(['message' => 'Đổi mật khẩu thành công'], 200);
    }
}
