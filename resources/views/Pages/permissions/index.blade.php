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
              <h6 class=" text-capitalize ps-3">Permissions table 
                
                @can('create permission')
                 <a href="{{url('permissions/create')}}" class="btn btn-primary float-end">Add Permission</a>
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
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                 @foreach ($permissions as $permission)
                     
                 <tr>
                    <td class="text-center">{{$permission->id}}</td>
                    <td class="text-center">{{$permission->name}}</td>
                    <td class="text-center">
                      @can('update permission')

                    <a href="{{url('permissions/'.$permission->id.'/edit')}}" class="btn btn-success">Edit</a>
                    @endcan
                    @can('delete permission')
                    <a href="{{url('permissions/'.$permission->id.'/delete')}}" class="btn btn-danger">Delete</a>
                    @endcan

                    </td>
                 </tr>
                 
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
  