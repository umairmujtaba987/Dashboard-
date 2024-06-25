<?php

namespace App\Http\Controllers;

use Str;

use App\Models\User;
use App\Mail\RegisterMail; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Notifications\AccountActivatedNotification; 

 
class DashboardController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('pages.dashboard',[
            'user' => $user

        ]);
    }
    public function notifications(){
        $notifications = auth()->user()->notifications;
        return view('pages.notifications', compact('notifications'));
    }
     
    public function profile(){
        $user = Auth::user();
        return view('pages.profile',[
            'user' => $user

        ]);
    }
     
    /*
    public function toggleStatus(User $user)
        {
            
           
    
            if($user->status=='active'){
           
                $user->status = 'Inactive';
                $user->save();
    
            }
            else
            {
                $user->status = 'active';
                $user->save();
                
                Mail::to($user->email)->send(new RegisterMail($user));
            }
    
            return back()->with('success', 'User status updated successfully.');
        }
    
        public function verify($token)
        {
            $user = User::where('remember_token', '=', $token)->first();
            if(!empty($user))
            {
                $user->email_verified_at = date('Y-m-d H:i:s'); 
                $user->status = 'active';
                $user->save();
                Mail::to($user->email)->send(new RegisterMail($user));
          
                return back()->with('success', 'User verify successfully.');
            }
            else{
                abort(404);
            }
        }

*/
}
