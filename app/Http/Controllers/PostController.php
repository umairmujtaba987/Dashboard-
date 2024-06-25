<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;

use App\Notifications\Notifications;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

class PostController extends Controller implements HasMiddleware  
{
    public static function middleware(): array
    {
        return [
            
            //new Middleware('role:super-admin', only: ['index']),
           // new Middleware('subscribed', except: ['store']),
           new Middleware(PermissionMiddleware::using('view publish posts'), only:['show']), 
           new Middleware(PermissionMiddleware::using('view post'), only:['index']), 
           new Middleware(PermissionMiddleware::using('create post'), only:['create','store']), 
           new Middleware(PermissionMiddleware::using('update post'), only:['update','edit']),
           new Middleware(PermissionMiddleware::using('delete post'), only:['destroy']),
            
        ];
    }
    

    public function show()
    {
         
         $posts = Post::where('status', 'publish')->get();
        // $posts = Post::with('user')->get();

         
        return view('pages.posts.publish',[
           
            'posts' => $posts
        ]);
    
    }

    public function index()
    {
         
            $posts = Post::where('user_id',auth()->id())->get();
             

            
        return view('pages.posts.index',[ 
            'posts' => $posts
        ]);
    }


    public function create(){
        return view('pages.posts.create');
    } 

    public function store(Request $request) {
       
        $incommingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'status' => 'required'
        ]);

        $incommingFields['title'] = strip_tags($request['title']);
        $incommingFields['body'] = strip_tags($request['body']);
        $incommingFields['status'] = $request->status;

        $incommingFields['user_id'] = auth()->id();
        Post::create($incommingFields);
        $message = ': Post has been created Successfully!';
        $name = [
            'name' => $request->title,
        ];
        auth()->user()->notify(new Notifications($name,$message));
        
        return response()->json(['message'=> 'Post created Successfully.']);
      //  return redirect('posts')->with('status', 'Post Created successfully.');
    

    }
    public function edit(Post $post)
    {
         if(auth()->user()->id === $post['user_id']){
            return view('pages.posts.edit', ['post' => $post
        ]);
        }
        elseif (auth()->user()->can('manage publish posts')) {
           
            return view('pages.posts.edit', ['post' => $post]);
        } 
        else{
            abort(403,'USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
        }
       

    }
    public function update(Post $post, Request $request){
         

        $incommingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
            
        ]);
        $incommingFields['title'] = strip_tags($request['title']);
        $incommingFields['body'] = strip_tags($request['body']);
        $incommingFields['status'] = $request->status;
      
        $post->update($incommingFields);
        $message = ': Post has been updated Successfully!';
        $name = [
            'name' => $post->title,
        ];
        auth()->user()->notify(new Notifications($name,$message));
        
        return redirect('/posts')->with('status', 'Post updated successfully.');

    }

    public function destroy(Post $post){
         
        if (auth()->user()->id === $post['user_id']){
            $message = ': Post has been deleted Successfully!';
            $name = [ 'name' => $post->title, ];
            auth()->user()->notify(new Notifications($name,$message));
            
            $post->delete();
        }
        elseif (auth()->user()->can('manage publish posts')) {
            
            $message = ': Post has been deleted Successfully!';
            $name = [ 'name' => $post->title, ];
            auth()->user()->notify(new Notifications($name,$message));
            $post->delete();
            
            return redirect('/posts/show')->with('status', 'Post deleted successfully.');
        }
        else{
            abort(403,' USER DOES NOT HAVE THE RIGHT PERMISSIONS.');
        }
        
        return redirect('/posts')->with('status', 'Post deleted successfully.');

    }


    public function update_status(Post $post ){
         

        if($post->status == 'publish')
        {

            $post->status = 'draft';
            
            $message = ': Post save in Draft Successfully!';
            $name = [ 'name' => $post->title, ];
            auth()->user()->notify(new Notifications($name,$message));
        }
        else{
            $post->status = 'publish';
            
            $message = ': Post has been Publish Successfully!';
            $name = [ 'name' => $post->title, ];
            auth()->user()->notify(new Notifications($name,$message));

        }
        $post->update();
        return redirect()->back()->withInput()->with('status', 'Post updated successfully.');

    }

   



}
