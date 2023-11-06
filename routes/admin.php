<?php


use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/test', function () {
    echo "Abhiram";
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin-login');
    Route::post('/login', [AdminController::class, 'loginPost'])->name('admin-login-post');

    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
        Route::get('/logout', [Admincontroller::class, 'adminLogout'])->name('admin-logout');
        Route::get('/profile', [Admincontroller::class, 'adminProfile'])->name('admin-profile');
        Route::post('/profile/update', [AdminController::class, 'adminProfileUpdate'])->name('admin-profile-update');
        Route::get('/change/password', [Admincontroller::class, 'changePassword'])->name('admin-change-password');

        Route::post('/update/password', [AdminController::class, 'updatePassword'])->name('admin-password-update');

        Route::get('user/blog/comments', [BlogController::class, 'index'])->name('admin-user-comment');
        Route::get('user/blog/comment/replay/{id}', [BlogController::class, 'commentReplay'])->name('admin-user-comment-replay');

        Route::post('/reply/message', [BlogController::class, 'replyMessagePost'])->name('reply-message-post');
    });
});
