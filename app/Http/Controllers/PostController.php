<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class PostController extends Controller
{
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::oldest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(5)->withQueryString(),
        ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
}
