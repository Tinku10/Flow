<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create(){
        $user = Auth::user();
        // dd($user);
        return view('posts.create', ['user'=>$user]);
    }
    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'post' => 'required',
            'user_id' => ''
        ]);
        auth()->user()->posts()->create($data);
        // Post::create($data);
        // $post = new Post();
        // $post->title = request('title')->validate(['title'=>'required']);
        // $post->user_id = auth()->user()->id;
        // $post->post = request('post')->validate(['post'=>'required']);
        // $post->save();
        return redirect('/home')->with('message', 'Your post has been submitted');
    }
}
