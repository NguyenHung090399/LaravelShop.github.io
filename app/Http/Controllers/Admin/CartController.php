<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Cart\CartService ;
use App\Models\Cart;
use App\Models\Customer;
use COM;

class CartController extends Controller
{
    protected $cart  ; 

    public function __construct(CartService $cart)
    {
        $this->cart = $cart ; 
    }
    

    public function index(){
        return view('admin.carts.list' , [
            'title'=>'Danh sách đơn hàng ',
            'customers'=>$this->cart->getCustomer() , 

        ]);
    }

    public function show(Customer $customer){
        return view('admin.carts.detail' , [
            'title'=>'Chi Tiết Đơn Hàng',
            'customer'=>$customer,
            'carts'=>$customer->carts()->with('product')->get()
        ]) ; 
    }   
}
