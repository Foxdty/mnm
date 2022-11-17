<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ManufacturerController;



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

Route::get('ad_categorypage', [PageController::class,'getCategoryList'])->name('danh-sach-danh-muc');
Route::get('ad_categoryeditpage', [CategoryController::class,'getCategoryDropdown'])->name('parent-danh-muc');
Route::get('ad_categoryeditpage/{id_category}', [CategoryController::class,'getEditCategory'])->name('chinh-danh-muc');

//--------------------Product--------------

Route::post('insertProduct',[ProductController::class,'insertProduct'])->name('ad_insertProduct');

Route::post('editProduct/{id}',[ProductController::class,'editProduct'])->name('ad_insertProduct');

Route::post('deletedProduct',[ProductController::class,'deletedProduct'])->name('xoa-product');

Route::post('searchProduct',[ProductController::class,'searchProduct'])->name('tim-kiem-product');

Route::get('ad_Product',[PageController::class,'ad_getAllProduct'])->name('ad_getAllProduct');

Route::get('ad_ProductEditPage',[PageController::class,'getProductEditPage'])->name('ad_getProductEditPage');

Route::post('ad_ProductEditPage',[PageController::class,'getProductEditPage'])->name('ad_getProductEditPage');
//------------- LOGIN ----------------------------
Route::post('postLogin', [UserController::class,'postLogin']);

//------------- LOGOUT ----------------------------

Route::post('postLogout',[UserController::class,'postLogout']);
//------------- REGISTER --------------------------------
Route::get('register', function () {
    return view('userpage.user_register');
});

Route::post('register', [UserController::class,'postRegister'])->name('dang-ky');

Route::get('shop',  [PageController::class,'getShop'])->name('shop');

Route::get('shop/category/{category}',  [ProductController::class,'findByCategory'])->name('shop-category');

Route::get('shop/manufacturer/{manufacturer}',  [ProductController::class,'findByManufacturer'])->name('shop-manufacturer');

//-------------------------------- Page --------------------------------

// --------------------------------Admin--------------------------------
Route::post('ad_blogeditpage/image_upload', [CkeditorController::class, 'upload'])->name('upload');
Route::get('ad_home', function () {
    return view('adminpage.ad_home');
});

Route::get('ad_userpage', [PageController::class,'getUserList'])->name('danh-sach-user');

Route::get('ad_usereditpage', function () {
    return view('adminpage.ad_usereditpage');
});

Route::get('delete_user', [UserController::class,'getDeleteUser'])->name('xoa-user');

Route::get('ad_usereditpage/{id}', [UserController::class,'editUser'])->name('chinh-User');

Route::post('updateUser/{id}', [UserController::class,'updateUser'])->name('ad_updateUser');


Route::post('insert_user', [UserController::class,'postInsertUser'])->name('them-user');
// ---------------------User------------------------

Route::get('/', [PageController::class,'getSlideListUserPage'])->name('danh-sach-slide-user-page');

Route::get('index', [PageController::class,'getSlideListUserPage'])->name('danh-sach-slide-user-page-index');


Route::get('login', function () {
    // session()->flush();
    return view('userpage.user_login');
});

Route::get('userEdit', function () {
    return view('userpage.user_edit');
});

Route::post('userEdit/{id}', [UserController::class,'userEdit'])->name('userEdit');

//------------- ORDER --------------------------------
Route::get('ad_orderpage', [OrderController::class,'getOrderList'])->name('danh-sach-order');

Route::post('change_status/{id_order}', [OrderController::class,'postChangeStatus'])->name('thay-doi-trang-thai');

Route::get('ad_orderdetailpage/{id_order}', [OrderController::class,'getOrderDetailView'])->name('chi-trang-chi-tiet-order');


//------------------------------- MANUFACTURE----------------------
Route::get('ad_Manufacturer', [ManufacturerController::class,'getAll'])->name('get-ad_Manufacturer');

Route::get('ad_manufacturereditpage', function () {
    return view('adminpage.ad_manufactureeditpage');
});

Route::post('ad_manufacturer', [ManufacturerController::class,'postInsert'])->name('them-Manufacturer');

Route::post('ad_manufacturer/{id}', [ManufacturerController::class,'postUpdate'])->name('update-Manufacturer');

Route::get('ad_manufacturer', [ManufacturerController::class,'postDelete'])->name('del-Manufacturer');

Route::get('ad_manufacturer/{id}', [ManufacturerController::class,'getEdit'])->name('edit-manufacturer');


//------------------------USER_CART START-------------------------

Route::get('cart', CartController::class,'getCart');

Route::post( 'add2cart',[CartController::class,'add2Cart'])->name('them-gio-hang');

Route::post('updateCart/{id}',[CartController::class,'updateCart'])->name('sua-gio-hang');

Route::post('delFromCart/{id}',[CartController::class,'delFromCart',])->name('xoa-gio-hang');

Route::get('delFromCart/{id}',[CartController::class,'delFromCart',])->name('xoa-gio-hang');

//------------------------------- Checkout----------------------//
Route::post('checkout', [CartController::class,'getCheckoutListUserPage'])->name('cart-checkout-userpage');

Route::get('checkout', CartController::class,'getCheckoutListUserPage');

Route::post('checkVoucher',[CheckoutController::class,'checkVoucher',])->name('kiem-tra-voucher');

Route::post('order',[CheckoutController::class,'postOrder',])->name('kiem-tra-voucher');


//------------------------------- Blog----------------------//
Route::get('blog', [PageController::class,'getBlogListUserPage'])->name('danh-sach-bai-viet-userpage');

Route::get('blog_details', function () {
    return view('userpage.user_blog_details');
});
Route::get('blog_details/{id_blog}', [BlogController::class,'getBlogDetailUserPage'])->name('chi-bai-viet-userpage');


//------------------------------- Slider----------------------//
Route::get('ad_slidepage', [PageController::class,'getSlideList'])->name('danh-sach-slide');

Route::get('ad_slideeditpage', function () {
    return view('adminpage.ad_slideeditpage');
});

Route::post('ad_slideeditpage', [SlideController::class,'postInsertSlide'])->name('them-slide');

Route::get('ad_slideeditpage/{id_slide}', [SlideController::class,'getEditSlide'])->name('chi-trang-edit-slide');

Route::post('update_slide/{id_slide}', [SlideController::class,'postUpdateSlide'])->name('sua-slide');

Route::get('delete_slide', [SlideController::class,'getDeleteSlide'])->name('xoa-slide');

//-------------||||------------------START Voucher----------------------//
//--------Admin------
Route::get('ad_voucherpage', [
    'as' => 'danh-sach-giam-gia',
    'uses' => 'App\Http\Controllers\PageController@getVoucherList'
]);

Route::get('ad_vouchereditpage', function () {
    return view('adminpage.ad_vouchereditpage');
});

Route::post('ad_vouchereditpage', [
    'as' => 'them-voucher',
    'uses' => 'App\Http\Controllers\VoucherController@postInsertVoucher'
]);

Route::get('ad_vouchereditpage/{id_voucher}', [
    'as' => 'chi-trang-voucher-edit',
    'uses' => 'App\Http\Controllers\VoucherController@getEditVoucher'
]);

Route::post('update_voucher/{id_voucher}', [
    'as' => 'chinh-voucher',
    'uses' => 'App\Http\Controllers\VoucherController@postUpdateVoucher'
]);

Route::get('delete_voucher', [
    'as' => 'xoa-voucher',
    'uses' => 'App\Http\Controllers\VoucherController@getDeleteVoucher'
]);

//-------------V----------------------------
Route::get('ad_voucherpage', [
    'as' => 'danh-sach-giam-gia',
    'uses' => 'App\Http\Controllers\PageController@getVoucherList'
]);

Route::get('ad_vouchereditpage', function () {
    return view('adminpage.ad_vouchereditpage');
});

Route::post('ad_vouchereditpage', [
    'as' => 'them-voucher',
    'uses' => 'App\Http\Controllers\VoucherController@postInsertVoucher'
]);

Route::get('ad_vouchereditpage/{id_voucher}', [
    'as' => 'chi-trang-voucher-edit',
    'uses' => 'App\Http\Controllers\VoucherController@getEditVoucher'
]);

Route::post('update_voucher/{id_voucher}', [
    'as' => 'chinh-voucher',
    'uses' => 'App\Http\Controllers\VoucherController@postUpdateVoucher'
]);

Route::get('delete_voucher', [
    'as' => 'xoa-voucher',
    'uses' => 'App\Http\Controllers\VoucherController@getDeleteVoucher'
]);

//-----------|||||--------------------START COMMENT----------------------//
Route::get('ad_commentpage', [
    'as' => 'danh-sach-binh-luan',
    'uses' => 'App\Http\Controllers\CommentController@getCommentList'
]);
Route::post('reply_comment/{id_comment}', [
    'as' => 'tra-loi-binh-luan',
    'uses' => 'App\Http\Controllers\CommentController@postReplyComment'
]);
Route::get('delete-comment', [
    'as' => 'xoa-comment',
    'uses' => 'App\Http\Controllers\CommentController@getDeteleComment'
]);
Route::post('comment_user', [
    'as' => 'them-comment-user-page',
    'uses' => 'App\Http\Controllers\CommentController@postInsertComment'
]);
