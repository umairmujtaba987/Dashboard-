@extends('layouts.head_nav')

@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Authors table</h6>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Role</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th> 
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                   
                    <tr class="text-center   ">
                     
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        {{-- <td>
                          
                          <form method="POST" action="{{ route('users.toggleStatus', $user->id) }}">
                            @csrf
                            @method('Put')
                            <button type="submit" class="btn btn-sm @if($user->status === 'active') btn-success @else btn-primary @endif">
                                @if($user->status === 'active' )
                                 Active
                                @else
                                   Inactive
                                @endif
                            </button>
                        </form>
                        </td> --}}
                        <td>
                          @if(empty($user->email_verified_at))
                          <form method="POST" action="{{ route('account.verify_token', $user->remember_token) }}">
                            @csrf
                            
                            <button type="submit" class="btn btn-sm btn-success " >
                          
                              verifiy 
                            </button>
                        </form>
                        @else
                        <button class="btn btn-sm ">Verified</button>
                    

                        </td>
                      
                        <!-- Display more user data columns as needed -->
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
 