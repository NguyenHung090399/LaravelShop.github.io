<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        $title = "Đăng nhập" ; 
        return view('admin.users.login')->with('title',$title);
    }

    public function store(Request $request){

        $validate = $request->validate([
            'email' => 'required|email:filter',
            'password'=> 'required'
        ]);

        if(Auth::attempt([
            'email'=> $request->input('email'),
            'password' => $request->input('password') 
        ] , $request->input('remember'))){
            return redirect()->route('admin') ; //goi den route co ten la admin
        }

        session()->flash('error' , 'Email hoặc Password không đúng !') ; //tao ra not bien session
        return redirect()->back() ; //quay lai
        

    }

}
