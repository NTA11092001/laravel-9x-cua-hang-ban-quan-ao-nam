<?php

use App\Http\Controllers\CMS\CategoryController;
use App\Http\Controllers\CMS\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WEB\HomeWebController;
use App\Http\Controllers\CMS\HomeCmsController;
use App\Http\Controllers\Auth\LoginCmsController;

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

Route::controller(LoginCmsController::class)->group(function (){
    Route::get('admin/login','login')->name('login');
    Route::post('admin/login', 'loginPost')->name('loginPost');
    Route::get('admin/register','register')->name('register');
    Route::post('admin/register','registerPost')->name('registerPost');
    Route::get('admin/logout','logout')->name('logout');
});

// CMS
Route::middleware('auth')->prefix('admin')->group(function (){
    // Home
    Route::controller(HomeCmsController::class)->group(function () {
        Route::get('/', 'index')->name('admin.home.index');

    });

    // Danh mục
    Route::prefix('/category')->controller(CategoryController::class)->group(function (){
        Route::get('/','index')->name('admin.category.index');
        Route::get('/create','create')->name('admin.category.create');
        Route::post('/create','store')->name('admin.category.store');
    });

    // Sản phẩm
    Route::prefix('/product')->controller(ProductController::class)->group(function () {
        Route::get('/', 'index')->name('admin.product.index');

    });


});


// END CMS

// WEB
Route::controller(HomeWebController::class)->group(function () {
    Route::get('/', 'index');

});
// END WEB
