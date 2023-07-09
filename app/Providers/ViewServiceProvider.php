<?php
 
namespace App\Providers;

use App\Http\View\Composers\CartComposer;
use App\Http\View\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
//use Illuminate\View\View;
 
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }
 
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('header' , MenuComposer::class) ;
        //1:Khai bao file MenuComposer
        //2: Truyen thong tin cua file menuComposer ra view (file header) va noi dung la MenuComposer::class
        //3: Dua file nay(ViewServiceProvider) vao thu muc config/app ( App\Providers\ViewServiceProvider::class,) de no chay duoc lenh ben tren

        View::composer('cart' , CartComposer::class) ; 
    }
}