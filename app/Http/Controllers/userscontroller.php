<?php

namespace App\Http\Controllers;

use Str;
use App\Models\User;

  
use App\Mail\RegisterMail;  
use Illuminate\Http\Request;
use App\Events\NewNotifiaction;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Notifications\Notifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Validator;

use App\Notifications\NewUserNotification;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Notifications\AccountActivatedNotification;  
use Spatie\Permission\Middleware\PermissionMiddleware;
 
class userscontroller extends Controller  implements HasMiddleware
{
    
    public static function middleware(): array
    {
        return [
            
            //new Middleware('role:super-admin', only: ['index']),
           // new Middleware('subscribed', except: ['store']),
           new Middleware(PermissionMiddleware::using('view user'), only:['index']),
           new Middleware(PermissionMiddleware::using('create user'), only:['create','store']), 
           new Middleware(PermissionMiddleware::using('update user'), only:['update','edit']),
           new Middleware(PermissionMiddleware::using('delete user'), only:['destroy']),
           new Middleware(PermissionMiddleware::using('user verify'), only:['verify']),
 
        ];
    }

    public function index()
    {
        
        
        
     $users = User::paginate(5);
     return view('pages.users.index',[
         'users' => $users
     ]);
    }
    public function view(User $userId)
   {
     
    return view('pages.users.user',[
        'user' => $userId
    ]);
    
   }
   public function create(){
    $roles = Role::pluck('name','name')->all();
    return view('pages.users.create',[
        'roles' => $roles
    ]);
}

    public function store(Request  $request)
    {
        $incommingFields = Validator::make($request->all(),[
            'name' => ['required', 'min:3' , Rule::unique('users', 'name')],
            'email' => 'required|email|unique:users' ,
            'password' => 'required|min:8', 
            //'roles' => 'required'
        ]);

        if($incommingFields->passes()){

            $user = New User();
            $user->name =$request->name;
            $user->email =$request->email;
            $user->password = Hash::make($request->password);
           
            $user->status = 'Inactive';
            $user->remember_token = Str::random(40);

            $user->syncRoles($request->roles);
            $user->save(); 
            $message = ':User has been created Successfully';
             auth()->user()->notify(new Notifications($user,$message));
            return redirect('/users')->with("success","You have created user successfully with roles but first permission user verify user to access our system");
           
           
        }
        else{
           
            return redirect('/users/create')
            ->withInput()
            ->withErrors($incommingFields);
        }
        
    
    }




    public function edit(User $user){

        $roles = Role::pluck('name','name')->all();
    $userRoles = $user->roles->pluck('name','name')->all();
        return view('pages.users.edit',['user' => $user,
        'roles' => $roles,
        'userRoles' => $userRoles
    ]);


    }   public function update(Request $request, User $user){
        
        
        $request->validate([
            'name' => ['required', 'min:3'],
            'roles' => 'required'
        ]);

        $data =[

            'name' => $request->name,
            'email' => $request->email


        ];
        if(!empty($request->password)){
            $data += [
                'password' => Hash::make($request->password),
            ];

        }

        $user->update($data); 
        $user->syncRoles($request->roles);
        $message = ':User has been updated Successfully!';
        auth()->user()->notify(new Notifications($user,$message));
        return redirect('users')->with('status', 'user Updated successfully with roles.');
   
    }

    public function destroy($userId){
        
        $user = User::findOrFail($userId);
        
        $message = ':User has been deleted Successfully!';
        auth()->user()->notify(new Notifications($user,$message));
        $user->delete();
        
        return redirect()->back()->with('status', 'user Deleted successfully.');
    
    }


    
    public function verify($token)
    {
        $user = User::where('remember_token', '=', $token)->first();
        if(!empty($user))
        {
            $user->email_verified_at = date('Y-m-d H:i:s'); 
            $user->status = 'active';
            $user->update();
            Mail::to($user->email)->send(new RegisterMail($user));
            
            $message = ':User has been verify Successfully!';
            auth()->user()->notify(new Notifications($user,$message));
            return back()->with('success', 'User verify successfully.');
        }
        else{
            abort(404);
        }
    }

}
