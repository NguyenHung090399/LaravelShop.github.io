<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'file'=>'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=>"Tên sản phẩm không được để trống !",
            'file.required'=>"Ảnh sản phâm không được để trống !"
        ] ; 
    }
}
