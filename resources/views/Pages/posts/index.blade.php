
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
    <div class="container mt-4 card mb-3" style="background-color: #d5f0ff;">
        <div class="card-body container border"style="#000000 ">
            
            <p class="card-text float-end"> 
              @can('update post')
              <a href="{{url('posts/'.$post->id.'/edit')}}" class="btn btn-primary ">Edit</a> 
                @if ($post->status != 'publish')
                  <a href="{{url('posts/'.$post->id.'/update_status')}}" class=" btn btn-primary ">Publish</a>
             @else
              <a href="{{url('posts/'.$post->id.'/update_status')}}" class="btn btn-secondary ">Un Publish</a>
           @endif
                @endcan
                  @can('delete post')
              <a href="{{url('posts/'.$post->id.'/delete')}}" class="btn btn-danger ">Delete</a> 
               @endcan
  
            
            </p> 
            <h3 class="card-title">{{$post['title']}}</h3>
            <p class="card-text ">{{$post['body']}}</p>
            
           
        </div>
    </div>
    
    @endforeach 
 

 
@endsection
 