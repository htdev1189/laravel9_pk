<?php

use Illuminate\Support\Facades\Route;

// backend
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SdtController;
use App\Http\Controllers\AdminController;

// frontend
use App\Http\Controllers\frontendController;

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

// frontend

Route::get('/', [frontendController::class, 'home']);
Route::get('/{slug}.html', [frontendController::class, 'post']);
Route::get('/{slug}', [frontendController::class, 'category']);

// gui sdt
Route::post('/guisdt', [SdtController::class, 'send']);


// login
Route::get('/admin/login', [AdminController::class,'loginView']);
Route::get('/admin/logout', [AdminController::class,'logout']);
// xu ly login
Route::post('/admin/xulyLogin', [AdminController::class,'xulyLogin']);



//admin
// Route::group(['prefix' => 'admin', 'middleware' => 'kiemtraLoginGuard'], function () {
Route::middleware('kiemtraLoginGuard')->prefix('admin')->group(function () {
    // dashboard
    Route::get('dashboard', function () {
        return view('backend/content');
    });

    // user
    // Route::group(['prefix' => 'user'], function () {
    Route::middleware('phanquyenUser:1')->prefix('user')->group(function () {
        Route::get('list', [AdminController::class, 'getAll']);
        Route::get('add', [AdminController::class, 'add']);
        Route::post('save', [AdminController::class, 'store']);
        Route::get('delete/{id}', [AdminController::class, 'delete']);
        Route::get('edit/{id}', [AdminController::class, 'edit']);
        Route::post('update', [AdminController::class, 'update']);
    });

    // Route::group(['prefix' => 'category'], function () {
    Route::middleware('phanquyenUser:1')->prefix('category')->group(function () {
        Route::get('list', [CategoryController::class, 'getAllCat']);
        Route::get('add', [CategoryController::class, 'add']);
        Route::post('save', [CategoryController::class, 'store']);
        Route::get('delete/{id}', [CategoryController::class, 'delete']);
        Route::get('edit/{id}', [CategoryController::class, 'edit']);
        Route::post('update', [CategoryController::class, 'update']);
    });

    // Route::group(['prefix' => 'posts'], function () {
    Route::middleware('phanquyenUser:2')->prefix('posts')->group(function () {
        Route::get('list', [PostController::class, 'getAllCat']);
        Route::get('add', [PostController::class, 'add']);
        Route::post('save', [PostController::class, 'store']);
        Route::get('delete/{id}', [PostController::class, 'delete']);
        Route::get('edit/{id}', [PostController::class, 'edit']);
        Route::post('update', [PostController::class, 'update']);
    });

    // Route::group(['prefix' => 'tongdai'], function () {
    Route::middleware('phanquyenUser:3')->prefix('tongdai')->group(function () {
        Route::get('list', [SdtController::class, 'getAll']);
    });
});
