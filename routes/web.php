<?php

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

Route::get('admin/login', [LoginCmsController::class,'login'])->name('login');
Route::post('admin/login', [LoginCmsController::class,'loginPost'])->name('loginPost');

Route::get('admin/register', [LoginCmsController::class,'register'])->name('register');
Route::post('admin/register', [LoginCmsController::class,'registerPost'])->name('registerPost');

Route::get('admin/logout', [LoginCmsController::class,'logout'])->name('logoutPost');

// CMS
Route::prefix('admin')->middleware('auth')->group(function (){
    Route::controller(HomeCmsController::class)->group(function () {
        Route::get('/', 'index')->name('admin.home');

    });
});


// END CMS

// WEB
Route::controller(HomeWebController::class)->group(function () {
    Route::get('/', 'index');

});
// END WEB
