 
 
<div class="row">
    <div class="col-xl-4"> 
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Profile Picture</div>
            @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif 
            <div class="card-body text-center"> 
                @if ($photo)
                <img class="rounded w-70 h-80 mt-2 block " src="{{ $photo->temporaryUrl() }}" alt="Profile Picture">
                <div class=" mt-2">
                <button class="btn btn-primary" wire:click="uploads" >Save</button>
            </div>
            @else 
            <img class="rounded w-70 h-80 mt-2 block " src="{{ url('storage/'.auth()->user()->profile_photo_path) }}" alt="Profile Picture" onclick="document.getElementById('photoInput').click()">
            <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div> 
            <input id="photoInput" type="file" wire:model="photo" style="display: none;">
             @error('photo') <span class="error">{{ $message }}</span> @enderror
            <button class="btn btn-primary" onclick="document.getElementById('photoInput').click()"  wire:model="photo" type="file" >Upload new image</button>
            </div>
            
            
          
        @endif
               
        </div>
    </div>