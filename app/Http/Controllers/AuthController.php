<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {       
       if(Auth::guard('karyawan')->attempt(['nik'=> $request->nik,'password'=>$request->password])){
            return redirect('/dashboard');
       } else {
            return redirect('/')->with(['warning'=>'Wrong Nik or Password']);
       }
    } 

    public function proseslogout(){
        if(Auth::guard('karyawan')->check()){
            Auth::guard('karyawan')->logout();
            return redirect('/');
        }
    }

    public function proseslogoutadmin()
    {
        Auth::guard('web')->logout(); // logout walaupun tidak login (aman)
        return redirect('/panel');
    }
    

    public function prosesloginadmin(Request $request)
    {       
       if(Auth::guard('web')->attempt(['email'=> $request->email,'password'=>$request->password])){
            return redirect('/panel/dashboardadmin');
       } else {
            return redirect('/panel')->with(['warning'=>'Wrong Email or Password']);
       }
    } 

}

