
@extends('layouts.head_nav')

@section('content')
    
   
   
   <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="card mt-4">
            <div class="card-header p-3">
              <h5 class="mb-0">Alerts</h5>
            </div>
            <div class="card-body p-3 pb-0">
              @foreach ($notifications as $notification)
              <div class="alert alert-success alert-dismissible text-white" role="alert">
                <span class="text-sm">{{ $notification->data['message'] }} </span>
                <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div> 
              @endforeach 
            </div>
          </div>
          
             
              </div> 
        </div>
      </div>
    
       
    </div> 
     
  @endsection