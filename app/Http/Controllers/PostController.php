<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
class PostController extends Controller
{
   
    public function index()
    {
          $posts = Post::with('user')->orderBy('created_at', 'asc')->get();

          return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create',compact('users'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'title'=>'required',
            'content'=>'required',
        ]);
        Post::create($request->all());
        return redirect('/posts')->with('success','Post Created Successfully!');
    }

    

    public function show($id)
    {
        $user = User::with('posts')->findOrFail($id);
        return view('posts.show',compact('user'));
    }
}
