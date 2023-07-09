<?php

namespace App\Http\Services\Product ;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductService{

    const LIMIT = 16 ; 
    public function get($page = null){ //mac dinh $page = null co nghia la mac dinh no se khong lam gi ca
        return Product::select('id','name','price' , 'price_sale','file')
            ->orderbyDesc('id')
            ->when($page != null, function($query) use ($page){
                $offset = $page* self::LIMIT ; 
                $query->offset($offset) ; 
            })
           
            ->limit(self::LIMIT)
            ->get() ; 
    }


    public function show($id){
        return Product::where('id',$id)
                    ->where('active' , 1)
                    ->with('menu')//Tu dong goi den ham menu (the hien lien ket) trong Product
                    ->firstOrFail() ; //Neu khong co se bao loi
    }

    public function more($id){
        return Product::select('id','name','price' , 'price_sale','file')
                    ->where('active',1)
                    ->where('id','!=',$id)
                    ->orderbyDesc('id')
                    ->limit(8)
                    ->get() ; 
    }
   
}