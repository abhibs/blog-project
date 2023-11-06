<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;



Route::get('', [HomeController::class, 'index'])->name('home');

Route::get('user/register', [UserController::class, 'register'])->name('user-register');
Route::post('user/register/post', [UserController::class, 'registerPost'])->name('user-register-post');

Route::get('user/login', [UserController::class, 'login'])->name('user-login');
Route::post('user/login/post', [UserController::class, 'loginPost'])->name('user-login-post');


Route::get('user/profile', [UserController::class, 'profile'])->name('user-profile');
Route::get('user/profile/edit', [UserController::class, 'editProfile'])->name('user-profile-edit');

Route::get('/blog/edit/{id}', [BlogController::class, 'edit']);
Route::get('/blog/detail/{id}/{slug}', [HomeController::class, 'blogDetails'])->name('blog-detail');

Route::get('user/blog/search', [BlogController::class, 'search'])->name('user-blog-search');

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('user/logout', [UserController::class, 'userLogout'])->name('user-logout');
    Route::post('user/profile/update', [UserController::class, 'userProfileUpdate'])->name('user-profile-update');
    Route::get('user/blog', [BlogController::class, 'blog'])->name('user-blog');
    Route::post('user/blog/store', [BlogController::class, 'store'])->name('user-blog-post');
    Route::post('user/blog/update', [BlogController::class, 'update'])->name('user-blog-update');
    Route::get('user/blog/delete/{id}', [BlogController::class, 'delete'])->name('user-blog-delete');
    Route::post('user/comment/store', [BlogController::class, 'userCommentStore'])->name('user-comment-store');
});





