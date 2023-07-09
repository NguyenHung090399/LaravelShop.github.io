<?php

namespace App\Http\Services\Slider;

use App\Models\Slider;
use Illuminate\Support\Facades\Log;

class SliderService{

    public function show(){
        return Slider::where('active',1)->orderbyDesc('sort_by')->get() ; 
    }

    public function get(){
        return Slider::orderby('id')->paginate(15) ; 
    }

    public function insert($request){
        try{
            Slider::create($request->all());
            session()->flash('success' , "Thêm Slider thành công !") ;  
        }catch(\Exception $err){
            session()->flash('error' , "Thêm Slider lỗi !") ; 
            Log::info($err->getMessage()) ; 
            return false ; 
        }

        return true ; 
    }

    public function update($request , $slider){
        try{
            $slider->fill($request->input()) ; 
            $slider->save() ; 
            session()->flash('success' , "Chỉnh Sửa Slider thành công ! ") ; 
        }catch(\Exception $err){
            session()->flash('error' , "Chỉnh sửa Slider lỗi !") ; 
            Log::info($err->getMessage()) ; 
            return false ; 
        }

        return true ; 
        
    }

    public function delete($request){
        $slider = Slider::where('id' , $request->input('id'))->first() ; 
        if($slider){
            $slider->delete() ; 
            return true ; 
        }

        return false ; 
    }

}