<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class UserProfile extends Component
{
    use WithFileUploads;
 
    public $photo; 
    public function uploads()
    {   
       
        $this->validate([
            'photo' => 'image|max:10000', // 1MB Max
        ]);
    
        $photoName = $this->photo->store('profile-photos', 'public');
        
        // Save the photo name to the user model
        auth()->user()->profile_photo_path = $photoName;
        auth()->user()->save();
        session()->flash('message', 'Photo successfully uploaded.');
        return redirect()->route('account.profile');
    }
    public function render()
    {
        return view('livewire.user-profile')->layout('layouts.head_nav');
    }
 

}
