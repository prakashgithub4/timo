<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
      return view('admin.login');
    }
    public function logggedin(Request $request){
        
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $login_array=array(
            'email'=>$request->email,
            'password'=>$request->password,
            'user_type'=>'admin');
           if (\Auth::attempt($login_array)) 
           {
                 return redirect('admin/dashbord');
           }
          else
          {
             return redirect('admin/login')->with('error', 'Invalid User name or password');
          }
    }
    public function logout(){
    	if (\Auth::check()) {
           // The user is logged in...
    		\Auth::logout();
    		 return redirect('admin/login')->with('success', 'User logout successfully');
          }
    }
}
