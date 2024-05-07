<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function index(){
        return view('admin.login');
    }

    
    public function authenticate(Request $request)
    {
        $incommingFields = Validator::make($request->all(),[
            'email' => 'required' ,
            'password' => 'required',
        ]);

        
        if($incommingFields->passes()){

            if(Auth::guard('admin')->attempt(['email' => $request->email,'password' =>$request->password])){
                       
                if(Auth::guard('admin')->user()->role !="admin")
                {
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error','You are not authorize to access this page.');


                }
                
                return redirect()->route('admin.dashboard');
                 
               
            }else{

              
                return redirect()->route('admin.login')->with('error','Either email or password is incorrect.');
            }
        }
        else{
           
            return redirect()->route('admin.login')
            ->withInput()
            ->withErrors($incommingFields);
        }

    
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

}
