<div>
   
    <h1>{{ $count }}</h1>
    <input type="file" wire:model="photo" >
    @error('photo') <span class="error">{{ $message }}</span> @enderror
   @if($photo)
   <img class="rounded w-10 h-10 mt-5 block " src="{{$photo->temporaryUrl()}}" alt="">
   @else
   <img twire:model="photo" src="{{ url('storage/'.auth()->user()->profile_photo_path)}}" alt="profile_image" class="w-10 h-10 border-radius-lg shadow-sm">
    
   @endif 
   
            
    <button wire:click="uploads">+</button>
 
    <button wire:click="decrement">-</button>
</div>
