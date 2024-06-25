<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    
    public function create(Request $request){
       
        $incommingFields = Validator::make($request->all(),[
            'name' => ['required', 'min:3' , Rule::unique('users', 'name')],
            'email' => 'required|email|unique:users' ,
            'password' => 'required|min:8', 
            //'roles' => 'required'
        ]);
        if($incommingFields->passes()){

            $user = New User();
            $user->name =$request->input('name');
            $user->email =$request->input('email');
            $user->password = Hash::make($request->input('password'));
           
            $user->status = 'Inactive';
            $user->remember_token = Str::random(40);
 
            $user->save(); 
            $message = ':User has been created Successfully by api';
            $supers = User::role('super-admin')->get(); 
        
            foreach ($supers as $super) {

                $super->notify(new Notifications($user,$message));
            } 
            //auth()->user()->notify(new Notifications($user,$message));
            return response()->json($user);
           
        }
        else{
           
            return response()->json('User not created');
            
        }
        
        
    

    }
  
    
    public function show()
    {
        $users = User::all();
        return response()->json($users);
    }
    public function showbyid($id)
    {
       
        if( ($user = User::find($id))){
        return response()->json($user);
        }
        else{
            
        return response()->json('User not found');
        }

    }
    public function update(Request $request, $id)
    {
       
        if( ($user = User::find($id))){

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        
            $user->update();
            return response()->json($user);

        }
        else{
            
        return response()->json('User not found for update');
        }

    }

    public function deletebyId($id)
    {
       
        if( ($user = User::find($id))){
            $user->delete();
            return response()->json( 'user delete successfully');
        }
        else{
            
        return response()->json('User not found for delete');
        }

    }
       
}