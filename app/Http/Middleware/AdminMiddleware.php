<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       /**  @var APP\Models\User */
        if(Auth::check()){
            $user =Auth::user();
            $roles = Role::all();
            if($user->hasRole($roles)){
                
                 return $next($request);
            }
            abort(403,"User does not have correct Role");
        }
        abort(401);
       // return redirect('account/dashboard');
    }
}
