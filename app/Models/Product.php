<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
        'menu_id',
        'price',
        'price_sale',
        'active',
        'file'
    ] ; 

    //Tao moi quan he voi bang menu: menu_id(Bang product)  = id(Bang Menu)
    public function menu(){
        return $this->hasOne(Menu::class , 'id' , 'menu_id')->withDefault(['name'=>'']); //hasOne the hien la : Mot san pham thi co 1 menu :
                                                                // ('id') la khoa chinh cua bang menu ('menu_id'):la khoa phu cua bang product
                                                                //withDefault(['name'=>'']) khi xoa mat danh muc trong bang menu thi truong danh muc trong bang product se de trong.
    }
}
