<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role; 
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\permission;  
use Spatie\Permission\Middleware\PermissionMiddleware;

use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
class RoleController extends Controller  implements HasMiddleware
{
    

 

   public static function middleware(): array
    {
        return [
            
            //new Middleware('role:super-admin', only: ['index']),
           // new Middleware('subscribed', except: ['store']),
           new Middleware(PermissionMiddleware::using('view role'), only:['index']),
           new Middleware(PermissionMiddleware::using('create role'), only:['create','store','addPermissionToRole','givePermissionToRole']), 
           new Middleware(PermissionMiddleware::using('update role'), only:['update','edit']),
           new Middleware(PermissionMiddleware::using('delete role'), only:['destroy']),
 
        ];
    }
    
  


    public function index(){
    
        $Roles = Role::all();
        return view('pages.role.index',  ['roles' => $Roles]);
    }  
    public function create(){
        return view('pages.role.create');
    } 
    
    public function store(Request  $request)
    {
       
        $request->validate([
            'name' => ['required','string','unique:roles,name'
            ]
        ]);
        Role::create([
            'name' => $request->name
        ]);
        return redirect('roles')->with('status', 'Role create sussfully.');
    }

    public function edit(Role $role){


        return view('pages.role.edit',['role' => $role]);


    }   public function update(Request $request, Role $role){
        
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ]
        ]);

        $role->update([
            'name' => $request->name
        ]);
        return redirect('roles')->with('status', 'Role Updated successfully.');
   
    }

    public function destroy($roleId){
        
        $role = Role::find($roleId);
        $role->delete();
        return redirect('roles')->with('status', 'Role Deleted successfully.');
    
    }

    public function addPermissionToRole($roleId){

        $permissions = Permission::all();
        $role= Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
        ->where('role_has_permissions.role_id', $role->id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id' )
        ->all();
        return view('pages.role.add-permissions', [
            'role'=> $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);

    }
    public function  givePermissionToRole(Request $request, $roleId){

      
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        $role->syncPermissions($request->permission);
        
        return redirect()->back()->with('status', 'Permission Added to Role');
    

    }

}
