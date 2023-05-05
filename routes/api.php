<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ChapterController;
use App\Http\Controllers\API\EvaluateController;
use App\Http\Controllers\API\LoginRegisterController;
use App\Http\Controllers\API\SearchController;
use App\Http\Controllers\API\TeachersController;
use Google\Client as GoogleClient;
use Google\Service\Oauth2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('cors')->group(function () {

    Route::middleware('CheckUserRole')->group(function () {
        Route::post('post/category', [CategoryController::class, 'createCategory'])->name('createCategory');
        Route::get('get/category', [CategoryController::class, 'getCategory'])->name('getCategory');
        // Route::delete('delete/{id}/category', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
        Route::post('post/course', [CategoryController::class, 'createCourse'])->name('createCourse');
        Route::get('get/course', [CategoryController::class, 'getCourse'])->name('getCourse');
        Route::put('update/{id}/category', [CategoryController::class, 'updateCategory'])->name('updateCategory');
        Route::put('update/{id}/course', [CategoryController::class, 'updateCourse'])->name('updateCourse');

        Route::post('post/chapter', [ChapterController::class, 'createChapter'])->name('createChapter');
        Route::put('update/{id}/chapter', [ChapterController::class, 'updateChapterTeacher'])->name('updateChapterTeacher');
        Route::get('delete/{id}/course', [CategoryController::class, 'deleteCourse'])->name('deleteCourse');

    });

    Route::get('get/{id}/chapter', [ChapterController::class, 'getChapter'])->name('getChapter');

    Route::get('detail/{id}/course', [CategoryController::class, 'getDetailCourse'])->name('getDetailCourse');

    Route::get('get/getCategories', [CategoryController::class, 'getCategories'])->name('getCategories');

    Route::get('get/{id}/getCoursesByTeacherId', [CategoryController::class, 'getCoursesByTeacherId'])->name('getCoursesByTeacherId');

    Route::get('get/courses/show', [CategoryController::class, 'getCoursesShow'])->name('getCoursesShow');

    Route::get('search/course', [SearchController::class, 'searchCourse'])->name('searchCourse');

    Route::get('get/teachers', [TeachersController::class, 'getTeachers'])->name('getTeachers');

    Route::get('teachers/{id}/courses', [TeachersController::class, 'getACourse'])->name('getACourse');

    Route::middleware('evaluate')->group(function () {

        Route::post('courses/{id}/evaluate', [EvaluateController::class, 'createEvaluate']);

        Route::post('change/password', [TeachersController::class, 'changePassword']);

        Route::put('update/user/profile', [TeachersController::class, 'updateUserProfile']);

    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::namespace('Api')->group(function () {

            Route::get('user', [LoginRegisterController::class, 'getUser'])->name('user');

            Route::post('refresh', [LoginRegisterController::class, 'refresh'])->name('refresh');

        });
    });
    Route::post('logout', [LoginRegisterController::class, 'logout'])->name('logout');

    Route::post('register', [LoginRegisterController::class, 'register'])->name('register');

    Route::post('login', [LoginRegisterController::class, 'login'])->name('login');

    Route::get('get/{id}/evaluate', [EvaluateController::class, 'getEvaluate'])->name('getEvaluate');

});

Route::get('/auth/google', function () {
    $client = new GoogleClient();
    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setRedirectUri(config('services.google.redirect'));
    $client->addScope('email');
    $client->addScope('profile');
    $authUrl = $client->createAuthUrl();
    return redirect($authUrl);
});

Route::get('/auth/google/callback', function (Request $request) {
    $client = new GoogleClient();
    $client->setClientId(config('services.google.client_id'));
    $client->setClientSecret(config('services.google.client_secret'));
    $client->setRedirectUri(config('services.google.redirect'));
    $client->addScope('email');
    $client->addScope('profile');

    if ($request->get('code')) {
        $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));
        $oauth = new Oauth2($client);
        $userData = $oauth->userinfo->get();

        $user = [
            'name' => $userData->name,
            'email' => $userData->email,
            'avatar' => $userData->picture,
            'token' => $token,
        ];
        session(['user' => $user]);

        return json_encode($user);
    }

});
