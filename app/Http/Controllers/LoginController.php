<?php

namespace App\Http\Controllers;
 
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Str;

class LoginController extends Controller
{
    //login for customer
    public function index()
    {
        return view('pages.sign-in');
    }

    public function authenticate(Request $request)
    {
        $incommingFields = Validator::make($request->all(),[
            'email' => 'required' ,
            'password' => 'required',
        ]);

        if($incommingFields->passes()){

            $remember = !empty($request->remember) ? true : false;
            if(Auth::attempt(['email' => $request->email,'password' =>$request->password], $remember)){

               
                if(empty(Auth::user()->email_verified_at))
                {
                   auth()->logout();
                    return redirect()->route('account.login')->with('error','Email is not approve yet.');
                    
                }
                else
                {
                   
                    $request->session()->regenerate();
                    return redirect()->route('account.dashboard');
      
                }
              
               
            }else{

              
                return redirect()->route('account.login')->with('error','Either email or password is incorrect.');
            }
        }
        else{
           
            return redirect()->route('account.login')
            ->withInput()
            ->withErrors($incommingFields);
        }

        
 
 
    }


    //register page
    public function register(){

        
        return view('pages.sign-up');

    }
    public function processRegister(Request $request)
    {
        $incommingFields = Validator::make($request->all(),[
            'name' => ['required', 'min:3' , Rule::unique('users', 'name')],
            'email' => 'required|email|unique:users' ,
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
        ]);

        if($incommingFields->passes()){

            $user = New User();
            $user->name =$request->name;
            $user->email =$request->email;
            $user->password = Hash::make($request->password);
            $user->status = 'Inactive';
            $user->remember_token = Str::random(40);
            $user->syncRoles('user');
            $user->save(); 

            return redirect()->route('account.login')->with("success","You have register successfully wait for admin approval");
           
           
        }
        else{
           
            return redirect()->route('account.register')
            ->withInput()
            ->withErrors($incommingFields);
        }

    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('account.login');
    }



}
