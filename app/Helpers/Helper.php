<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Helper{
    public static function menu($menus , $parent_id = 0 , $char=''){
        $html = '' ; 
        foreach($menus as $key=>$value){
            if($value->parent_id==$parent_id){
                $html .= '
                    <tr>
                        <td>' . $value->id . '</td>
                        <td>' . $char.$value->name . '</td>
                        <td>' . self::active($value->active) . '</td>
                        <td>' . $value->updated_at . '</td>
                        <td style="width:100px;">
                            <a href="/admin/menus/edit/'.$value->id.'" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="" class="btn btn-danger btn-sm" onclick="removeRow('.$value->id.' , \'/admin/menus/destroy\')">
                                <i class="fas fa-trash"></i>
                            </a>
                            
                           
                        </td>
                    </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus , $value->id , $value->id , $char.'--');
            }
        }

        return $html ; 
    }

    public static function active($active){
        return $active == 0 ? '<span class="btn btn-danger">No<span>':'<span class="btn btn-success">Yes</span>';
    }


    public static function menus($menus , $parent_id = 0){
        $html = '' ; 
        foreach($menus as $key => $value){
            if($value->parent_id == $parent_id){
                $html.='
                    <li>
                        <a href="/danh-muc/'.$value->id.'-'.Str::slug($value->name, '-') .'.html">
                            '.$value->name.'
                        </a>' ;

                     unset($menus[$key]) ; //Nhung cai lay ra roi thi xoa di    
                     if(self::isChild($menus , $value->id)){
                        $html .= '<ul class="sub-menu">' ;
                        $html .= self::menus($menus , $value->id) ;
                        $html .= '</ul>' ; 
                     } 
                        
                $html .='</li>


                ';
            }
        }

        return $html ; 
    }

    //Kiem tra xem co danh muc cap 2 khong 
    public static function isChild($menus , $id){
        foreach($menus as $key=>$value){
            if($value->parent_id==$id){
                return true ; 
            }
        }
        return false ; 
    }

    public static function price($price , $priceSale){
        if($priceSale!=0) return number_format($priceSale) ; //number_format chu so co phan cach hang tram, chuc, don vi boi dau ,
        else return number_format($price) ; 
    }
}