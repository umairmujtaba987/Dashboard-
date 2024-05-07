
@extends('layouts.head_nav')

@section('content')
    
<div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <h4>Create User
            <a href="{{url('users')}}" class="btn btn-danger float-end">Back</a>
          </h4>
        </div>
        <div class="card-body">
            <form action="{{url('users')}}" method="POST">
            @csrf
            <div class="input-group input-group-outline mb-3">
              <label class="form-label"></label>
              <input name="name" type="text" class="form-control" value="{{old('name')}}" placeholder="UserName">
              <span class="text-danger">@error('name'){{$message}} @enderror</span>
              
            </div>
            <div class="input-group input-group-outline mb-3">
              <input name="email" type="email" class="form-control" value="{{old('email')}}" placeholder="Email">
              <span class="text-danger">@error('email'){{$message}} @enderror</span>
              
            </div>
            <div class="input-group input-group-outline mb-3"> 
              <input name="password" type="password" class="form-control" value="{{old('password')}}" placeholder="Password">
              <span class="text-danger">@error('password'){{$message}} @enderror</span>
              
            </div> 
            <div class=" mb-3"> 
              <label for="">Select Role</label>
             
              <div class="row">
                @foreach ($roles as $role)
                
                <div class="col-md-2">
                   <label for="">
                    <input
                     type="checkbox"
                      name='roles[]' 
                      value="{{$role}}"
                         />
                    {{$role}}
                   </label>
                    
                </div>  
                @endforeach

            </div>
            
            
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary container mt-3">Save</button>
                </div>

            </form>

        </div>

      </div>
    </div>
   
  </div>
  
  
  @endsection