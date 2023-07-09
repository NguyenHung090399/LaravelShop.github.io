<?php

namespace App\Http\Services\Product ;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductAdminService{

    public function getMenu(){
        return Menu::where('active',1)->get(); //lay ra danh sach danh muc co cac active =1 
    }
//lay ra danh sach san pham
    public function get(){
        return Product::with('menu')->orderby('id')->paginate(15) ; 
        //with('menu):lien ket voi bang menu 'menu':la funcition moi quan he trong class Product
    }

    //kiem tra gia tien price_sale luon nho hon price
    public function isValidPrice($request){
        $price = $request->input('price') ; 
        $price_sale = $request->input('price_sale');

        if($price != 0 && $price_sale != 0){
            if($price_sale >= $price){
                session()->flash('error','Giá giảm phải nhỏ hơn giá gốc');
                return false;
            }
        }else{
            if($price==0){
                session()->flash('error',"Vui lòng nhập giá gốc ! ");
                return false;
            }
        }

        return true;
    }

    public function insert($request){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice==false) return false;

        try{
        $request->except('_token'); //bo di token
        Product::create($request->all()) ; 

            session()->flash('success','Thêm sản phẩm thành công !') ; 
        }catch(\Exception $err){
            session()->flash('error','Thêm sản phẩm lỗi !') ; 
            Log::info($err->getMessage());
            return false ; 
        }

        return true;
    }

    public function update($request , $product){
        $isValidPrice = $this->isValidPrice($request);
        if($isValidPrice==false) return false;

        try{
            $product->fill($request->input()) ; 
            $product->save();
            session()->flash('success','Cập nhật sản phẩm thành công !') ; 

        }catch(\Exception $err){
            session()->flash('error' , "Cập nhật sản phẩm bị lỗi !") ; 
            Log::info($err->getMessage()) ;
            return false ;  
        }

        return true ; 
 
    }

    public function delete($request){
        $product = Product::where('id' , $request->input('id'))->first() ; 
        if($product){
            $product->delete() ; 
            return true;
        }
        
        return false;
        
    }

}