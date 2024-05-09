
@extends('layouts.head_nav')
@section('content')
    
    <div class="container mt-4">
       
    <h1>Edit Post</h1>
    <form action={{url('posts/'.$post->id)}} method="POST">
    @csrf
    @method('PUT')
    <label >Title:</label>
    <input type="text" name="title" value="{{$post->title}}">
    <textarea name="body"  class="form-control" rows="4" placeholder="Post Body Content" style="mix-width: 100%">{{$post->body}}</textarea>
    
    <div class="mb-3">
        <h5 for="">Status:</h5>
        <select class="form-control " name="status">
          <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
          <option value="publish" {{ $post->status == 'publish' ? 'selected' : '' }}>Publish</option>
        </select>
    </div>
    
    <button class="mt-2">Save Changes</button>
    
    </form>
    </div>
    @endsection