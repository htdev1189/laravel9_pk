<?php

use Illuminate\Support\Facades\Route;

// backend
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SdtController;

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

Route::get('/',[frontendController::class,'home']);
Route::get('/{slug}.html',[frontendController::class,'post']);
Route::get('/{slug}',[frontendController::class,'category']);

// gui sdt
Route::post('/guisdt',[SdtController::class,'send']);




//admin
Route::group(['prefix'=>'admin'],function(){

    // dashboard
    Route::get('dashboard', function () {
        return view('backend/content');
    });

    //ajax
    // Route::post('/ajax/get_category','ajaxController@get_category');
    // Route::group(['prefix'=>'category'],function(){
    //    Route::get('list','CategoryController@list');
    //    Route::get('add','CategoryController@get_insert');
    //    Route::post('store','CategoryController@store');
    //    Route::get('delete/{id}','CategoryController@delete')->where([
    //        'id' => '[0-9]+'
    //    ]);
    //     Route::get('edit/{id}','CategoryController@edit')->where([
    //         'id' => '[0-9]+'
    //     ]);
    //     Route::post('update','CategoryController@update');
    // });

    Route::group(['prefix'=>'category'],function(){
        Route::get('list',[CategoryController::class,'getAllCat']);
        Route::get('add',[CategoryController::class,'add']);
        Route::post('save',[CategoryController::class,'store']);
        Route::get('delete/{id}',[CategoryController::class,'delete']);
        Route::get('edit/{id}',[CategoryController::class,'edit']);
        Route::post('update',[CategoryController::class,'update']);

    });

    Route::group(['prefix'=>'posts'],function(){
        Route::get('list',[PostController::class,'getAllCat']);
        Route::get('add',[PostController::class,'add']);
        Route::post('save',[PostController::class,'store']);
        Route::get('delete/{id}',[PostController::class,'delete']);
        Route::get('edit/{id}',[PostController::class,'edit']);
        Route::post('update',[PostController::class,'update']);

    });

    Route::group(['prefix'=>'tongdai'],function(){
        Route::get('list',[SdtController::class,'getAll']);
    });
    // Route::group(['prefix'=>'product'],function(){
    //    Route::get('list','ProductController@list');
    //    Route::get('add','ProductController@add');
    //    Route::post('add','ProductController@store');
    //    Route::get('delete/{id}','ProductController@delete')->where([
    //        'id' => '[0-9]+'
    //    ]);
    //     Route::get('edit/{id}','ProductController@edit')->where([
    //         'id' => '[0-9]+'
    //     ]);
    //     Route::post('update/','ProductController@update');
    // });
    //user
    // Route::group(['prefix'=>'user'],function(){
    //     Route::get('list','UserController@list');
    //     Route::get('add','UserController@add');
    //     Route::post('add','UserController@store');
    //     Route::get('delete/{id}','UserController@delete')->where([
    //         'id' => '[0-9]+'
    //     ]);
    //     Route::get('edit/{id}','UserController@edit')->where([
    //         'id' => '[0-9]+'
    //     ]);
    //     Route::post('update','userController@update');
    // });
});


