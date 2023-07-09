<?php
namespace App\Http\Services\Menu ;

use App\Models\Menu;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;

class MenuService{

    public function show(){
        return Menu::select('id' , 'name' , 'description')->orderbyDesc('id')->where('parent_id',0)->get() ; 
    }

    public function getParent(){
        return Menu::where('parent_id' , 0)->get(); // Lay toan bo cac danh muc co parenr_id = 0
    }

    public function getAll(){
        return Menu::orderbyDesc('id')->paginate(10); //Lay tat ca danh muc theo thu tu id giam dan.paginate la phan trang
    }

    public function getID($id){
        return Menu::where('id' , $id)->where('active' , 1)->firstOrFail() ; //firstOrFail() : la khong tim thay
    }

    public function getProduct($menu , $request){
        $query =  $menu->products()->select('id' , 'name' , 'price' , 'price_sale' , 'description' , 'file')
                    ->where('active',1);
                    if($request->input('price')){ //$request->input('price' : luc nay co hai gia tri desc hoac aesc
                        $query->orderby('price' , $request->input('price')) ; 
                    }
                    return $query->orderby('id') 
                                ->paginate(12)
                                ->withQueryString();  
    }

    public function create($request){
       try{
            Menu::create([
                'name'=>$request->input('name'),
                'parent_id'=>$request->input('parent_id'),
                'description'=>$request->input('description'),
                'content'=>$request->input('content'),
                'active'=>$request->input('active')
            ]);

            session()->flash('success' , 'Tạo danh mục thành công !');
       }catch(\Exception $err){
            session()->flash('error' , $err->getMessage());
            return false;
       }

       return true;
    }

    public function update($request , $menu){
        // $menu->fill($request->input()); //thay vi tao array giong create thi minh dung fill de lay toan bo cac truong ma nguoi dung nhap
        $menu->name = $request->input('name');
        if($request->input('parent_id') != $menu->id){
            $menu->parent_id = $request->input('parent_id');
        }
        $menu->description = $request->input('description');
        $menu->content = $request->input('content');
        $menu->active = $request->input('active');
        $menu->save();

        session()->flash('success' , 'Cập nhật thành công !') ; 
        return true ; 
    }

    public function destroy($request){

        $id = $request->input('id');  
        $menu = Menu::where('id' , $id)->first(); // first la lay mot thang trong do
        if($menu){
            return Menu::where('id',$id)->orwhere('parent_id',$id)->delete() ; 
        }
        return false;
    }

}