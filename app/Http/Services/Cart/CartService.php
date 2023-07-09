<?php

namespace App\Http\Services\Cart ;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Cart;

class CartService{

    public function getCustomer(){
        return Customer::orderbyDESC('id')->paginate(15) ; 
    }

    public function getProductCart($customer){
         
    }

}