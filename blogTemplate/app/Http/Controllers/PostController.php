<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::latest()->take(1)->get();
        $posts2 = Post::latest()->skip(1)->take(2)->get();
        $posts3=Post::latest()->skip(3)->take(3)->get();
        return view('/index', ['posts' => $posts,'posts2' => $posts2,'posts3' => $posts3] );
    }
}
