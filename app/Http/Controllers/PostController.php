<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::all();
        return view('post.index', compact('posts'));
    }
    public function publish(Post $post){
        $post->update([
            'is_published'=>true,
        ]);
        return back();
    }
}
