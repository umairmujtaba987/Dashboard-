<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission; 

use Spatie\Permission\Middleware\PermissionMiddleware;

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
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
        return redirect('permissions')->with('status', 'permission Updated successfully.');
   
    }

    public function destroy($permissionId){
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect('permissions')->with('status', 'permission Deleted successfully.');
    
    }
}
