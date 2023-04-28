<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use file;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Storage;

class AddUserController extends Controller
{
    /*
    Add User
     */
    public function addUser(UserRequest $request)
    {

        $image = $request->file('avatar');
        $path = Storage::disk('google')->putFileAs('/', $image, $image->getClientOriginalName());
        $url = Storage::disk('google')->url($path);

        $create = User::create([
            'hoTen' => $request->hoTen,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'soDienThoai' => $request->soDienThoai,
            'ngaySinh' => date('Y-m-d', strtotime($request->ngaySinh)),
            'gioiTinh' => $request->gioiTinh,
            'diaChi' => $request->diaChi,
            'avatar' => $url,
            'trangThai' => $request->trangThai,
            'phanQuyen' => $request->phanQuyen,
        ]);
        return redirect()->back()->with('success', 'Thêm người dùng thành công');
    }

    public function userManagement()
    {

        $userId = Auth::user()->id;

        $users = User::select('id', 'hoTen', 'avatar', 'phanQuyen', 'trangThai', 'email', 'soDienThoai', 'gioiTinh', 'ngaySinh', 'diaChi')
            ->where('id', '!=', $userId)
            ->where('phanQuyen', 2)
            ->orderBy('last_seen', 'DESC')
            ->paginate(5);

        return view('Admin.userManagement.index', compact('users'));
    }

    public function userLecturers()
    {
        $userId = Auth::user()->id;
        $users = User::select('id', 'hoTen', 'avatar', 'phanQuyen', 'trangThai', 'email', 'soDienThoai', 'gioiTinh', 'ngaySinh', 'diaChi')
            ->where('id', '!=', $userId)
            ->where('phanQuyen', 1)
            ->orderBy('last_seen', 'DESC')
            ->paginate(5);

        return view('Admin.userManagement.index2', compact('users'));
    }

    public function userEdit($id)
    {

        $user = User::where('id', $id)->firstOrFail();

        return view('Admin.userManagement.edit', compact('user'));

    }

    public function userUpdate(Request $request, $id)
    {

        if ($request->file('avatar')) {

            dd('oke');

        } else {
            dd('cc');
        }

    }

    public function userDelete($id)
    {
        User::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Xóa người dùng thành công');

    }
}
