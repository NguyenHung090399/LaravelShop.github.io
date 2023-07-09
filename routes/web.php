<?php

use App\Http\Controllers\Admin\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\MainController as ControllersMainController;
use App\Http\Services\Upload\UploadService;
use App\Models\Menu;
use Illuminate\Support\Facades\App;

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

Route::get('admin/users/login' , [LoginController::class , 'index'])->name('login');
Route::post('admin/users/login/store' , [LoginController::class , 'store']);


Route::middleware(['auth'])->group(function(){ //->group() gom nhom cac route phai dang nhap
    //Danh muc
    Route::prefix('admin')->group(function(){ //prefix gom cac duong dan co chung tien to
        //Muon vao duoc admin/main thi phai qua cai middleware:De xac nhan phai dang nhap ms vao duoc
        //Neu khong dang nhap ma vao duong dan thi no se tra ve giao dien login 
        Route::get('/' , [MainController::class,'index'])->name('admin');
        Route::get('main' , [MainController::class,'index']);


        //Menu
        Route::prefix('menus')->group(function(){
            Route::get('add' , [MenuController::class , 'create']);
            Route::post('add' , [MenuController::class , 'store']);
            Route::get('list' , [MenuController::class , 'index']);
            Route::get('edit/{menu}' , [MenuController::class , 'edit']);
            Route::post('edit/{menu}' , [MenuController::class , 'update']);
            Route::delete('destroy' , [MenuController::class , 'destroy']);

        });

        //Product
        Route::prefix('products')->group(function(){
            Route::get('add' , [ProductController::class , 'create']);
            Route::post('add' , [ProductController::class , 'store']);
            Route::get('list' , [ProductController::class , 'index']);
            Route::get('edit/{product}' , [ProductController::class , 'edit']);
            Route::post('edit/{product}' , [ProductController::class , 'update']);
            Route::delete('destroy' , [ProductController::class , 'destroy']);

        });

        //Slider
        Route::prefix('sliders')->group(function(){
            Route::get('add' , [SliderController::class , 'create']);
            Route::post('add' , [SliderController::class , 'store']);
            Route::get('list' , [SliderController::class , 'index']);
            Route::get('edit/{slider}' , [SliderController::class , 'edit']);
            Route::post('edit/{slider}' , [SliderController::class , 'update']);
            Route::delete('destroy' , [SliderController::class , 'destroy']);

        });

        //Upload
        Route::post('upload/services' ,[UploadController::class , 'store']);

        //Cart
        Route::get('customers' , [CartController::class , 'index']) ; 
        Route::get('customers/view/{customer}' , [CartController::class , 'show']) ; 

    });


});

Route::get('/' , [\App\Http\Controllers\MainController::class , 'index']) ; 
Route::post('/services/load-product' , [\App\Http\Controllers\MainController::class , 'loadProduct']) ; 

Route::get('danh-muc/{id}-{slug}.html',[\App\Http\Controllers\MenuController::class , 'index']);
Route::get('san-pham/{id}-{slug}.html',[\App\Http\Controllers\ProductController::class , 'index']);

Route::post('add-cart',[\App\Http\Controllers\CartController::class , 'index']) ; 
Route::get('carts',[\App\Http\Controllers\CartController::class , 'show']) ; 
Route::post('update-cart',[\App\Http\Controllers\CartController::class , 'update']) ; 
Route::get('carts/delete/{id}',[\App\Http\Controllers\CartController::class , 'remove']) ; 

Route::post('carts',[\App\Http\Controllers\CartController::class , 'addCart']) ; 