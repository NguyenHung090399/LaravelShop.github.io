<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Http\Services\Menu\ProductAdminService;
use App\Http\Services\Product\ProductAdminService as ProductProductAdminService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductProductAdminService $productService)
    {
        $this->productService = $productService;
    }

    
    public function index()
    {
        return view('admin.products.list' , [
            'title'=>'Danh sách sản phẩm',
            'products'=>$this->productService->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.add' , [
            'title'=>'Thêm sản phẩm',
            'menus'=>$this->productService->getMenu()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $this->productService->insert($request) ; 

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit',[
            'title'=>'Chỉnh sửa sản phẩm',
            'product' =>$product,
            'menus'=>$this->productService->getMenu()
        ]) ; 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
       // dd($request->input()) ; 
        $result = $this->productService->update($request , $product) ; 
        if($result==true) return redirect('admin/products/list');
        else return redirect()->back() ; 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $result = $this->productService->delete($request) ;
        
        if($result){
            return response([
                'error'=>false , 
                'message'=>'Xoá thành công sản phẩm !'

            ]);
        }

        return response([
            'error'=>true
        ]) ; 
    }
}
