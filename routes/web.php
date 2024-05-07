<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\userscontroller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;




 
Route::get('/', [LoginController::class,'index'])->name('account.login')->middleware('guest');
Route::group(['prefix'=>'account'],function(){

    //redirect to login
    Route::group(['middleware' => 'guest'],function(){
        Route::get('login', [LoginController::class,'index'])->name('account.login');
        Route::get('register', [LoginController::class,'register'])->name('account.register');
        Route::Post('process-register', [LoginController::class,'processRegister'])->name('account.processregister');
        Route::post('/authenticate', [LoginController::class,'authenticate'])->name('account.authenticate');
        
    });
    //dashboard redirect
    Route::group(['middleware' => 'auth'],function(){
        
        Route::get('logout', [LoginController::class,'logout'])->name('account.logout');
        Route::get('dashboard', [DashboardController::class,'index'])->name('account.dashboard');
        Route::get('profile', [DashboardController::class,'profile'])->name('account.profile');
        Route::get('userstable', [DashboardController::class,'usertable'])->name('account.users');
       
    });

});

//Route::group(['middleware' => ['role:super-admin|admin|user']],function(){
Route::group(['middleware' => ['isAdmin']],function(){

Route::resource('users', userscontroller::class);
Route::get('users/{userId}/delete', [userscontroller::class, 'destroy']);
Route::Post('verify_token/{token}', [userscontroller::class ,'verify'])->name('account.verify_token');
       
Route::resource('roles', RoleController::class)->middleware('auth');
Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy']);
//->middleware('permission:delete role');;
Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);

Route::resource('permissions', PermissionController::class);
Route::get('permissions/{permissionId}/delete', [PermissionController::class, 'destroy']);

});
/*
    Route::group(['prefix'=>'admin'],function(){

    Route::group(['middleware' => 'admin.guest'],function(){
      
        Route::post('authenticate', [AdminLoginController::class,'authenticate'])->name('admin.authenticate');
     
        Route::get('login', [AdminLoginController::class,'index'])->name('admin.login');
      

    });
    Route::group(['middleware' => 'admin.auth'],function(){
        
        Route::get('dashboard', [AdminDashboardController::class,'index'])->name('admin.dashboard');

        Route::get('logout', [AdminLoginController::class,'logout'])->name('admin.logout');
        
        Route::get('tables', [AdminDashboardController::class,'tables'])->name('admin.tables');
        Route::Post('verify_token/{token}', [AdminDashboardController::class ,'verify'])->name('admin.verify_token');
  
     
        //Route::put('tables/{user}',[ AdminDashboardController::class ,'toggleStatus'])->name('users.toggleStatus');
    
    });

});

*/