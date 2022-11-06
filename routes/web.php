<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

Route::get('/', function () {
    return view('user_master');
});

// -------------------Category---------------

Route::post('insert_category', [CategoryController::class, 'postInsertCategory'])->name('them-danh-muc');
Route::post('insert_category_parent', [CategoryController::class,'postInsertCategoryParent'])->name('them-danh-muc-parent');
Route::post('update_category/{id_category}', [CategoryController::class,'postUpdateCategory'])->name('update-danh-muc');
Route::get('delete_categories', [CategoryController::class,'getDeleteCategory'])->name('xoa-danh-muc');



//--------------------Product--------------

Route::post('insertProduct',[ProductController::class,'insertProduct'])->name('ad_insertProduct');

Route::post('editProduct/{id}',[ProductController::class,'editProduct'])->name('ad_insertProduct');

Route::post('deletedProduct',[ProductController::class,'deletedProduct'])->name('xoa-product');

Route::post('searchProduct',[ProductController::class,'searchProduct'])->name('tim-kiem-product');

//------------- LOGIN ----------------------------
Route::post('postLogin', [UserController::class,'postLogin']);

//------------- LOGOUT ----------------------------

Route::post('postLogout',[UserController::class,'postLogout']);
//------------- REGISTER --------------------------------
Route::get('register', function () {
    return view('userpage.user_register');
});

Route::post('register', [UserController::class,'postRegister'])->name('dang-ky');





