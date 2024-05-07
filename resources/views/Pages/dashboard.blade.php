@extends('layouts.head_nav')

@section('content')
    
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">{{ Auth::user()->name }}  </h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-3 border">
                 
                  <tbody> 
                    <tr >
                      <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder ">Role</th>
                      <td >
                        
                        @if(!empty($user->getRoleNames()))
                        @foreach ($user->getRoleNames() as $rolename)
                            <label for="" class="badge bg-secondary mx-1">{{ $rolename }}</label>
                        @endforeach
                        @endif  
                      </td>
                    </tr>
                    <tr >
                        <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder  ps-2">Permissions</th> 
                      
                      <td class="mt-5">
                        <div class="row">
                          @if(!empty($user->getAllPermissions()))
                          @foreach ($user->getAllPermissions() as $pm) 
                          
                          <div class="col-md-2">
                            <label for="" class="badge bg-secondary md-1">{{ $pm->name }}</label>
                       
                              
                          </div>  
                          @endforeach
                          @endif  
                          
                        </td>
                    </tr>
                         
                      <tr>
                        <th class="text-center text-uppercase text-dark text-xxs font-weight-bolder  ">Status</th> 
                    
                        <td class="mt-5">
                          @if(empty(Auth::user()->email_verified_at))                          
                            <label for="" class="badge bg-secondary md-1">Not Verify</label>
                          @else
                            <label for="" class="badge bg-secondary md-1">Verified</label>
                          @endif 
                        </td>
                      </tr>  
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    </div>
    


    
  </div>
  @endsection