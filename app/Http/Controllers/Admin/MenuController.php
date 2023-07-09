<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use App\Http\Services\Menu\MenuService;
use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuservices;

    public function __construct(MenuService $menuService)
    {
        $this->menuservices = $menuService;
    }

    public function index(){
        return view('admin.menus.list' , [
            'title'=>'Danh Sách Danh Mục',
            'menus'=>$this->menuservices->getAll()
        ]);
    }
    public function create(){
        return view('admin.menus.add' , [
            'title'=>"Thêm Danh Mục Mới",
            'menus'=>$this->menuservices->getParent()
        ]) ; 
    }

    public function store(CreateFormRequest $request){
        $this->menuservices->create($request) ;
        return redirect()->back() ;         
    }

    public function edit(Menu $menu){ //Menu $menu : tu dong kiem tra id co ton tai trong data khong
        return view('admin.menus.edit',[
            'title'=>'Chỉnh Sửa Danh Muc : '.$menu->name,
            'menu'=>$menu,
            'menus'=>$this->menuservices->getParent()
        ]);
    }

    public function update(Menu $menu , CreateFormRequest $request ){ //validate du lieu goi CreateFormRequest
        $this->menuservices->update($request,$menu);
        return redirect('admin/menus/list');
    }
    //Xoa danh muc
    public function destroy(Request $request){
        $result = $this->menuservices->destroy($request);

        if($result){
            return response()->json(
                [
                    'error'=>false, //khong co loi
                    'message'=>"Xóa thành công danh mục"
                ]
            );
        }else{
            //co loi
            return response()->json([
                'error'=>true
            ]);
        }
    }
}
