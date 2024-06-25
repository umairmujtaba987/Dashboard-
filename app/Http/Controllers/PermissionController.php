<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Notifications\Notifications;

use Spatie\Permission\Models\Permission; 

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class PermissionController extends Controller implements HasMiddleware  
{
    
    public static function middleware(): array
    {
        return [
            
            //new Middleware('role:super-admin', only: ['index']),
           // new Middleware('subscribed', except: ['store']),
           new Middleware(PermissionMiddleware::using('view permission'), only:['index']),
           new Middleware(PermissionMiddleware::using('create permission'), only:['create','store']), 
           new Middleware(PermissionMiddleware::using('update permission'), only:['update','edit']),
           new Middleware(PermissionMiddleware::using('delete permission'), only:['destroy']),
 
        ];
    }

    public function create(){
        return view('pages.permissions.create');
    } 
    public function index(){
    
        $permissions = Permission::all();
        return view('pages.permissions.index',  ['permissions' => $permissions]);
    }  
    
   
    public function store(Request  $request)
    {
        $request->validate([
            'name' => ['required','string','unique:permissions,name'
            ]
        ]);
        Permission::create([
            'name' => $request->name
        ]);
        
        $message = ': Permission has been created Successfully!'; 
        auth()->user()->notify(new Notifications($request,$message));
        return redirect('permissions')->with('status', 'permission create sussfully.');
    }

   
    
    public function edit(permission $permission){




        return view('pages.permissions.edit',['permission' => $permission]);


    }   public function update(Request $request, Permission $permission){
        
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        $permission->update([
            'name' => $request->name
        ]);
        
        $message = ': Permission has been updated Successfully!'; 
        auth()->user()->notify(new Notifications($permission,$message));
        return redirect('permissions')->with('status', 'permission Updated successfully.');
   
    }

    public function destroy($permissionId){
        $permission = Permission::find($permissionId);

        $permission->delete();
        
        $message = ': Permission has been deleted Successfully!'; 
        auth()->user()->notify(new Notifications($permission,$message));
        return redirect('permissions')->with('status', 'permission Deleted successfully.');
    
    }
}
