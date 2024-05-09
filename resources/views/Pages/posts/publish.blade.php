
@extends('layouts.head_nav')
@section('content')

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        @if (session('status'))
        <div class="alert alert-success">{{session('status')}}</div>
        @endif
        <div class="card my-4 mt-5">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class=" shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class=" text-capitalize ps-3">
                 Blog Posts
                @can('create post')
                 <a href="{{url('posts/create')}}" class="btn btn-primary float-end">Add Post</a>
                @endcan
                </h6>
                
            </div>
          </div>
 
    @foreach ($posts as $post)
    <div class="container mt-4 card mb-3" style="background-color: #2e2d2d;">
        <div class="card-body container border"style="color: #ffffff; ">
            
            <p class="card-text">Posted by: {{  $post->user->name }}</p>
            <h3 class="card-title">{{$post['title']}}</h3>
            <p class="card-text">{{$post['body']}}</p>
            
            @can('manage publish posts')
            <p><a href="{{url('posts/'.$post->id.'/edit')}}" class="btn btn-primary">Edit</a> 
            
            <a href="{{url('posts/'.$post->id.'/delete')}}" class="btn btn-secondary">Delete</a></p>
             @endcan
        </div>
    </div>
    
    @endforeach 
 

 
@endsection
 