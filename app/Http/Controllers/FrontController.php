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
        $categories = Category::take(5)->get();

        // Tags untuk sidebar
        $tags = Tag::take(5)->get();

        // Recent posts hanya published
        $recentPosts = Post::where('status', 'published')
            ->whereDate('publish_date', '<=', now())
            ->latest()
            ->take(5)
            ->get();

        return view('index', compact('posts', 'categories', 'tags', 'recentPosts'));
    }

    public function show($slug)
    {
        // Cari post berdasarkan slug
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->whereDate('publish_date', '<=', now())
            ->firstOrFail();

        return view('show', compact('post'));
    }

    public function categories()
    {
        $categories = Category::withCount(['posts' => function ($query) {
            $query->where('status', 'published')
                ->whereDate('publish_date', '<=', now());
        }])->get();

        return view('categories', compact('categories'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = Post::where('category_id', $category->id)
            ->where('status', 'published')
            ->whereDate('publish_date', '<=', now())
            ->orderBy('publish_date', 'desc')
            ->paginate(6);

        return view('category', compact('category', 'posts'));
    }

    public function tags()
    {
        $tags = Tag::withCount(['posts' => function ($query) {
            $query->where('status', 'published')
                ->whereDate('publish_date', '<=', now());
        }])->get();

        return view('tags', compact('tags'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = $tag->posts()
            ->where('status', 'published')
            ->whereDate('publish_date', '<=', now())
            ->orderBy('publish_date', 'desc')
            ->paginate(6);

        return view('tag', compact('tag', 'posts'));
    }

    public function archives()
    {
        // Ambil daftar bulan & tahun dari posting published
        $archives = Post::selectRaw('YEAR(publish_date) as year, MONTH(publish_date) as month, COUNT(*) as post_count')
            ->where('status', 'published')
            ->whereDate('publish_date', '<=', now())
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return view('archives', compact('archives'));
    }

    public function archive($year, $month)
    {
        // Ambil post berdasarkan tahun & bulan
        $posts = Post::whereYear('publish_date', $year)
            ->whereMonth('publish_date', $month)
            ->where('status', 'published')
            ->whereDate('publish_date', '<=', now())
            ->orderBy('publish_date', 'desc')
            ->paginate(6);

        // Format nama bulan
        $monthName = \Carbon\Carbon::createFromDate(null, $month, 1)->format('F');

        return view('archive', compact('posts', 'year', 'monthName'));
    }
}
