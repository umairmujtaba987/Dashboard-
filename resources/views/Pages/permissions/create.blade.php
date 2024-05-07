
@extends('layouts.head_nav')

@section('content')
    
<div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <h4>Create Permission
            <a href="{{url('permissions')}}" class="btn btn-danger float-end">Back</a>
          </h4>
        </div>
        <div class="card-body">
            <form action="{{url('permissions')}}" method="POST">
            @csrf
                <div class="mb-3">
                    <label for=""> Permission Name</label>
                    <input type="text" name='name' class="form-control border" />

                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>

      </div>
    </div>
   
  </div>
  
  @endsection