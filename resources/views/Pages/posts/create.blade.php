
@extends('layouts.head_nav')
@section('content')
<header>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset("https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js")}}" integrity="sha512-bztGAvCE/3+a1Oh0gUro7BHukf6v7zpzrAb3ReWAVrt+bVNNphcl2tDTKCBr5zk7iEDmQ2Bv401fX3jeVXGIcA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  
</header>
<body>
  
<div class="row">
    <div class="col-md-12">  

      <div class="card">
        <div class="card-header">
          <h4>Create Post
            <a href="{{url('posts')}}" class="btn btn-danger float-end">Back</a>
          </h4>
        </div>
        <div class="card-body">
            <form action="{{url('posts')}}" method="POST" id="addpost">
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
                    <input id='submit' type="submit" class="btn btn-primary container mt-3" value="Save"> 
                    </div>
            </form>

        </div>

      </div>
    </div>
   
  </div> 

  <script src="https://code.jquery.com/jquery-3.5.1.js" > </script>
  {{-- <script>
        $(document).ready(function()
          { 
             
            $('#addpost').on('submit',function(event) {
             
             event.preventDefault();
              jQuery.ajax({
                  url:"{{url('posts')}}",
                  data:jQuery('#addpost').serialize(),
                  type:'post',

                  success:function(result){
 
                     alert(result.message);

                    jQuery('#addpost')[0].reset();
                  }
                   
              })
              
            });
             
          });

        </script>
--}}
        
</body>
@endsection