<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider = $slider ; 
    }


    public function index()
    {
        return view('admin.sliders.list' , [
            'title'=>"Danh sách Slider",
            'sliders'=>$this->slider->get()
        ]);
    }

    
    public function create()
    {
        return view('admin.sliders.add' , [
            'title'=>'Thêm Slider',
        ]) ; 
    }

    public function store(Request $request)
    {
        //Thay vi tao mot form request de validate thi minh co the tao truc tiep
        $this->validate($request,[
            'name'=>'required',
            'file'=>'required',
            'url'=>'required',
        ]);

        $this->slider->insert($request) ; 

        return redirect()->back() ; 
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit' , [
            'title'=>'Chỉnh Sửa Slider ',
            'slider'=>$slider,
        ]) ; 
    }


    public function update(Request $request, Slider $slider)
    {
        $result = $this->slider->update($request , $slider) ; 
        if($result){
            return redirect('admin/sliders/list') ; 
        }
        return redirect()->back() ; 
    }

    public function destroy(Request $request)
    {
        $result = $this->slider->delete($request) ; 
        if($result){
            return response([
                'error'=>false,
                'message'=>'Xóa thành công Slider !'
            ]);
        }
        return response([
            'error'=>true
        ]) ; 
    }
}
