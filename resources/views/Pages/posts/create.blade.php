
@extends('layouts.head_nav')
@section('content')

<div class="row">
    <div class="col-md-12">

      <div class="card">
        <div class="card-header">
          <h4>Create Post
            <a href="{{url('posts')}}" class="btn btn-danger float-end">Back</a>
          </h4>
        </div>
        <div class="card-body">
            <form action={{url('posts')}} method="post">
                @csrf
                <input class="form-control border" type="text" name="title" placeholder="Post title"   >
                <textarea name="body"  class="form-control border" rows="7" placeholder="Post Body Content" style="mix-width: 100%"></textarea>
                 
                <div class="mb-3">
                    <h5 for="">Status:</h5>
                    <select class="form-control " name="status">
                      <option value="draft" selected>Draft</option>
                      <option value="publish">Publish</option>
                    </select>
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