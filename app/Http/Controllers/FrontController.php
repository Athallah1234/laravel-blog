<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        // Ambil posts yang hanya 'published' dan sudah waktunya publish
        $posts = Post::where('status', 'published')
            ->whereDate('publish_date', '<=', now())
            ->orderBy('publish_date', 'desc')
            ->paginate(6); // pagination

        // Categories untuk sidebar
        $categories = Category::all();

        // Tags untuk sidebar
        $tags = Tag::all();

        // Recent posts hanya published
        $recentPosts = Post::where('status', 'published')
            ->whereDate('publish_date', '<=', now())
            ->latest()
            ->take(5)
            ->get();

        return view('index', compact('posts', 'categories', 'tags', 'recentPosts'));
    }
}
