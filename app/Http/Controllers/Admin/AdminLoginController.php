<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminLoginController extends Controller
{
    public function loginForm()
    {
        return view('Admin.Login.adminLogin');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Phải đúng định dạng email',
            'password.required' => 'Mật khẩu không được để trống',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('dashboard');

        }
        return redirect()->back()->withErrors([
            'errors' => 'Email & mật khẩu sai!',
        ]);
    }

    public function logout()
    {

        Auth::logout();
        return redirect('login');

    }

    public function checkLogin()
    {
        $offlineTime = Cache::get('user' . Auth::user()->id . 'offline_time');
        if ($offlineTime) {
            $offlineDuration = Carbon::parse($offlineTime)->diffInMinutes(now());
            dd($offlineDuration);
        } else {
            $offlineDuration = null;
        }
    }

}
