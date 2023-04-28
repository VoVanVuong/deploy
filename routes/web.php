<?php

use App\Http\Controllers\Admin\AddUserController;
use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Support\Facades\Route;
use Spatie\Analytics\Period;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/*
Admin Dashboard
 */
Route::middleware('adminLogin')->group(function () {
    Route::get('dashboard', function () {

        return view('Admin.dashboard.dashboardAdmin');

    })->name('admin-dashboard');

    Route::get('analytics', function () {

        $analytics = Analytics::fetchMostVisitedPages(Period::days(7));

        dd($analytics);

    });

    Route::get('user/check', [AdminLoginController::class, 'checkLogin']);

    Route::middleware('adminMiddleware')->group(function () {
        Route::get('user', function () {

            return view('Admin.user.addUser');

        })->name('admin-add-user');

        Route::get('quan-li-nhan-vien', [AddUserController::class, 'userManagement'])->name('user-management');
        Route::get('quan-li-giang-vien', [AddUserController::class, 'userLecturers'])->name('user-lecturers');

        Route::get('user/edit/{id}', [AddUserController::class, 'userEdit'])->name('user-edit');
        Route::post('user/update/{id}', [AddUserController::class, 'userUpdate'])->name('user-update');

        Route::get('user/delete/{id}', [AddUserController::class, 'userDelete'])->name('user-delete');
        Route::post('add/User', [AddUserController::class, 'addUser'])->name('add-User');
    });

    Route::get('logout', [AdminLoginController::class, 'logout'])->name('logout-admin');

});

/*
Login Admin
 */

Route::get('login/test', function () {
    return view('Admin.userManagement.test');
});

Route::get('category', function () {
    return view('Admin.userManagement.category');
});

Route::get('course', function () {
    return view('Admin.userManagement.testkhoa');
});

Route::middleware('adminLogout')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'loginForm'])->name('admin-login');
    Route::post('/login', [AdminLoginController::class, 'login']);
});
