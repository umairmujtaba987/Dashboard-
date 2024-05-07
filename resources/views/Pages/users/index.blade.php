@extends('layouts.head_nav')

@section('content')
    

  <div class="row">
    <div class="col-md-12">

      
        
       
    </div>
   
  </div>

  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        @if (session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
        @endif
        <div class="card my-4 mt-5">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class=" shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class=" text-capitalize ps-3">users table
                @can('create user')
                 <a href="{{url('users/create')}}" class="btn btn-primary float-end">Add user</a>
                @endcan
                </h6>
                
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                    
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ROles</th>
                    
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($users as $user)
                  @if(Auth::user()->id != $user->id)
                 <tr class="md-2">
                    <td class="text-center">{{$user->id}}</td>
                    <td class="text-center">{{$user->name}}</td>
                    <td class="text-center">{{$user->email}}</td>
                    <td class="text-center">
                      @if(!empty($user->getRoleNames()))
                      @foreach ($user->getRoleNames() as $rolename)
                          <label for="" class="badge bg-info mx-1">{{ $rolename }}</label>
                      @endforeach
                      @endif  
                    </td>
                    
                    <td class="text-center">
                      
                      @if(empty($user->email_verified_at))
                      @can('user verify')
                      <form method="POST" action="{{ route('account.verify_token', $user->remember_token) }}">
                        @csrf
                        
                        <button type="submit" class="btn btn-sm btn-success " >
                        verifiy 
                        </button>
                       
                           
                            
                       

                      </form>
                      @else
                       
                      <button class="btn btn-sm  ">Not Verified</button>
                      @endcan 
                      
                      @else
                      <button class="btn btn-sm ">Verified</button>
                      @endif
                    </td>
                  
                    <td class="text-center">
                      
                      @can('update user')
                        <a href="{{url('users/'.$user->id.'/edit')}}" class="btn btn-success">Edit</a>
                        @endcan
                        @can('delete user')
                        <a href="{{url('users/'.$user->id.'/delete')}}" class="btn btn-danger">Delete</a>
                        @endcan
                      </td>
                   </tr>
                   
                 @endif
                 @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </div>

  @endsection
  