<?php
 
namespace App\Http\View\Composers;

use App\Models\Menu;
use Illuminate\View\View;
 
class MenuComposer
{
    
    protected $users ; 
    public function __construct() {

    }
 
   
    public function compose(View $view)
    {
        //Lay cac danh muc active = 1  , select ra cac truong la id , name , parent_id
        $menus = Menu::select('id' , 'name' , 'parent_id')->where('active' , 1)->orderbyDesc('id')->get() ; 
        $view->with('menus' , $menus);
    }
}