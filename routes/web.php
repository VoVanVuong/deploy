<?php

use App\Http\Controllers\Admin\AddUserController;
use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Http\Request;
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

Route::get('/update/user', function () {
    return view('Admin.userManagement.update');
});

Route::post('category/post', function (Request $request) {

    $vimeo = new Vimeo("4306103b2bcaa19d344453bab5913d4d6fdf3721",
        "X+juKdZtvs8pnfA5UCsIWVcSyepTugkSJlkiTBD/kgVB6WZGVKM4A7aKkkHVWfmEPVWua2kXGfNLMbTkn4KnTHz0nLLQRKLQhAZgSIphh997ZjeZETb4+mstlvkL0SiE",
        "a5afc1cd26b4d5bea6865b85bd636c3d");

    $file = $request->file('video');

    $vimeoVideoLink = Vimeo::upload($file, [
        'name' => 'Football',
        'description' => 'Brazil is the best country to learn about football',
    ]);

    $vimeoVideoId = explode('videos/', $vimeoVideoId)[1];

    $video = json_decode($vimeoVideoId);

})->name('post-video');
Route::get('course', function () {
    return view('Admin.userManagement.testkhoa');
});

Route::middleware('adminLogout')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'loginForm'])->name('admin-login');
    Route::post('/login', [AdminLoginController::class, 'login']);
});
