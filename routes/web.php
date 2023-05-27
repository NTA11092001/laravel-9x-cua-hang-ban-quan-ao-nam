<?php

use App\Http\Controllers\Auth\AuthWebController;
use App\Http\Controllers\CMS\CartCmsController;
use App\Http\Controllers\CMS\CategoryController;
use App\Http\Controllers\CMS\MemberController;
use App\Http\Controllers\CMS\ProductController;
use App\Http\Controllers\WEB\AccountController;
use App\Http\Controllers\WEB\PaymentController;
use App\Http\Controllers\WEB\ProductWebController;
use App\Http\Controllers\CMS\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\MainWebController;
use App\Http\Controllers\CMS\MainCmsController;
use App\Http\Controllers\Auth\AuthCmsController;
use App\Http\Controllers\WEB\CartController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::controller(AuthCmsController::class)->group(function (){
    Route::get('admin/login','login')->name('login');
    Route::post('admin/login', 'loginPost')->name('loginPost');
    Route::get('admin/register','register')->name('register');
    Route::post('admin/register','registerPost')->name('registerPost');
    Route::get('admin/logout','logout')->name('logout');
});

// CMS
Route::middleware('auth')->prefix('admin')->group(function (){
    // Home
    Route::controller(MainCmsController::class)->group(function () {
        Route::get('/', 'index')->name('admin.home.index');

    });

    // Danh mục
    Route::prefix('/category')->controller(CategoryController::class)->group(function (){
        Route::get('/','index')->name('admin.category.index');
        Route::get('/create','create')->name('admin.category.create');
        Route::post('/create','store')->name('admin.category.store');
        Route::get('/edit','edit')->name('admin.category.edit');
        Route::post('/update','update')->name('admin.category.update');
        Route::post('/delete','destroy')->name('admin.category.delete');
        Route::post('/status','status')->name('admin.category.status');
    });

    // Sản phẩm
    Route::prefix('/product')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('admin.product.index');
        Route::get('/create', 'create')->name('admin.product.create');
        Route::post('/store', 'store')->name('admin.product.store');
        Route::get('/edit','edit')->name('admin.product.edit');
        Route::post('/update','update')->name('admin.product.update');
        Route::post('/delete','destroy')->name('admin.product.delete');
        Route::post('/status','status')->name('admin.product.status');
    });

    Route::prefix('/cart')->controller(CartCmsController::class)->group(function (){
        Route::get('/', 'index')->name('admin.cart.index');
        Route::get('/show','show')->name('admin.cart.show');
        Route::post('/status','status')->name('admin.cart.status');
        Route::post('/delete','destroy')->name('admin.cart.delete');
        Route::post('/cancel/{id}','cancel')->name('admin.cart.cancel');
    });

    Route::prefix('/member')->controller(MemberController::class)->group(function (){
        Route::get('/', 'index')->name('admin.member.index');
    });

    Route::prefix('user')->controller(UserController::class)->group(function (){
        Route::post('/store', 'store')->name('admin.user.store');
        Route::get('/edit','edit')->name('admin.user.edit');
        Route::post('/update','update')->name('admin.user.update');
        Route::post('/delete','destroy')->name('admin.user.delete');
        Route::post('/status','status')->name('admin.user.status');
        Route::get('/create', 'create')->name('admin.user.create');
        Route::post('/password','password')->name('admin.user.password');
        Route::get('/{status}', 'index')->name('admin.user.index');
        Route::post('/destroy','delete')->name('admin.user.destroy');
    });

});
// END CMS

Route::controller(AuthWebController::class)->group(function (){
    Route::post('/login', 'loginPost')->name('loginWebPost');
    Route::post('/register','registerPost')->name('registerWebPost');
    Route::get('/logout','logout')->name('logoutWeb');
});

// WEB
Route::controller(MainWebController::class)->group(function () {
    Route::get('/', 'index')->name('WEB.home.index');
    Route::get('/lien-he', 'contact')->name('WEB.contact.index');
});

Route::prefix('san-pham')->controller(ProductWebController::class)->group(function (){
    Route::get('/danh-muc-{id}','category')->name('WEB.product.category');
    Route::get('/{id}','show')->name('WEB.product.detail');
});

Route::prefix('gio-hang')->controller(CartController::class)->group(function (){
    Route::get('/', 'cartList')->name('WEB.cart.list');
    Route::post('/store', 'addToCart')->name('WEB.cart.store');
    Route::post('/update', 'updateCart')->name('WEB.cart.update');
    Route::post('/remove', 'removeCart')->name('WEB.cart.remove');
    Route::post('/clear', 'clearAll')->name('WEB.cart.clear');
});
Route::middleware('member')->group(function (){
    Route::controller(PaymentController::class)->group(function (){
        Route::get('/dat-hang', 'index')->name('WEB.payment');
        Route::post('/store', 'store')->name('WEB.payment.store');
        Route::get('/thanh-cong', 'success')->name('WEB.payment.success');
        Route::post('/change-status','status')->name('WEB.change-status');
    });

    Route::prefix('tai-khoan')->controller(AccountController::class)->group(function (){
        Route::get('/','index')->name('WEB.account');
        Route::get('/lich-su', 'history')->name('WEB.history');
        Route::get('/xem-don-hang','show')->name('WEB.cart_detail');
        Route::post('/password','password')->name('WEB.member.password');
        Route::post('/update','update')->name('WEB.member.update');
        Route::post('/cancel/{id}','cancel')->name('WEB.cart.cancel');
    });
});

// END WEB
