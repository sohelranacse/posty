<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        // laravel build
        $posts = Post::latest()->paginate(20);

        // select row
        // $posts = Post::selectRaw("*")
        //         ->latest()
        //         ->paginate(5);

        // another way
        // $posts = DB::table('posts')->get();
        // paginate
        // $posts = DB::table('posts')->paginate(5);

        // raw query
        // $posts = DB::select("SELECT * FROM posts");

        return view('posts.index', ['posts' => $posts]);
    }
    
    public function store(Request $request) {
        $this->validate($request, [
            'body' => 'required'
        ]);

        $request->user()->posts()->create($request->only('body'));

        return back();
    }
}