<?php

namespace App\Http\Services\Product ;

// use App\Jobs\SendMail;
// use App\Models\Cart;
// use App\Models\Customer;

use App\Jobs\SendMail;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

use function PHPSTORM_META\type;

class CartService{

    public function create($request){
       
        $qty = (int)$request->input('num_product') ; 
        $product_id = (int)$request->input('product_id') ; 

        if($qty <=0 || $product_id <=0){
            Session::flash('error' , "Số lượng hoặc sản phẩm không đúng !") ; 
            return false ; 
        }

        //tao session
        $carts = Session::get('carts') ; 
        if(is_null($carts)){ //Neu chua co giỏ hàng nào cả thi se tao giỏ hàng
            //tao Session
            Session::put('carts', [
                $product_id=>$qty
            ]) ; 

            return true ; 
        }
        
        //Nguoc lai thi cap nhat gia tri cu = gia tri cu + gia tri moi them vao
        $exists = Arr::exists($carts , $product_id) ; // Kiem tra xem product_id da ton tai trong cart hay chua
        if($exists){ // Neu no da co thi minh se update, co chua co thi minh se tao moi
            // cap nhat 
            $carts[$product_id] = $carts[$product_id] + $qty ; 
            Session::put('carts', $carts)  ;
            return true ; 
        }
        $carts[$product_id] = $qty ; 
        Session::put('carts' , $carts) ; 

        return true ; 
                                  
    }

    public function getProduct(){
        $carts = Session::get('carts') ; 
        if(is_null($carts)) return [] ; 

        $productId = array_keys($carts) ; //(array_keys:tap hop cac khoa cua mang): Lay ra danh sach cac id cua cac san pham
        return Product::select('id','name','price','price_sale','file')
                    ->where('active',1)
                    ->whereIn('id' , $productId)
                    ->get() ; 
    }

    public function update($request){ 
        Session::put('carts' , $request->input('num_product')) ;  //Cap nhat lai sesstion ,update cac so luong moi
        $carts = Session::get('carts') ; 
        foreach($carts as $key=>$value){
            if($carts[$key]==0){
                unset($carts[$key]) ; 
            }
        }
        Session::put('carts' , $carts) ; 
        return true ; 
    }

    public function remove($id){
        $carts = Session::get('carts') ; 
        unset($carts[$id]) ; //Xoa 
        Session::put('carts' , $carts) ; //Cap nhat lai
        
    }

    public function addCart($request){
        try {

            DB::beginTransaction() ; //Neu trong qua trinh chay try bi loi thi no se rollback lai,con neu khong loi no se commit
            //Kiem tra thong tin san pham co hay khong
            $carts = Session::get('carts') ; 
            if(is_null($carts)) return [] ; 
            //  insert thong tin khach hang
            $customer = Customer::create([
                'name'=>$request->input('name'),
                'phone'=>$request->input('phone'),
                'address'=>$request->input('address'),
                'email'=>$request->input('email'),
                'content'=>$request->input('content')
            ]) ; 

            //Neu co san pham thi lay thong tin san pham
            $productId = array_keys($carts) ; //(array_keys:tap hop cac khoa cua mang): Lay ra danh sach cac id cua cac san pham
            $products =  Product::select('id','name','price','price_sale','file')
                    ->where('active',1)
                    ->whereIn('id' , $productId)
                    ->get() ; 

            //Them vao bang Cart
            $this->infoProductCart($carts , $customer->id) ; 

            DB::commit() ; 
            Session::flash('success' , 'Đặt hàng thành công !') ;


            //Queue 
            //Goi den SendMail
            //Truyen email khach hang vao dispatch
            SendMail::dispatch($request->input('email'))->delay(now()->addSeconds(2)) ; //now:thoi gian hien tai addSecond(5): Cho 2 s sau ms hui mail
             

            //Dat hang song thi xoa don hang
            //Session::flush() ;         
            Session::forget('carts') ; 

            
        } catch (\Exception $err) {
            DB::rollBack() ; 
            Session::flash('error' , "Đặt hàng lỗi, Vui lòng thử lại !") ; 
            return false ; 
        }

        return true ; 
    }

    public function infoProductCart($carts , $customer_id){
        $productId = array_keys($carts) ; //(array_keys:tap hop cac khoa cua mang): Lay ra danh sach cac id cua cac san pham
        $products =  Product::select('id','name','price','price_sale','file')
                ->where('active',1)
                ->whereIn('id' , $productId)
                ->get() ; 

        foreach($products as $product){
            $data[] = [
                'customer_id' => $customer_id,
                'product_id'=>$product->id,
                'quantity'=> $carts[$product->id],
                'price'=> $product->price_sale!=0 ? $product->price_sale : $product->price
            ] ; 
        }

        return Cart::insert($data) ; 
    }
}