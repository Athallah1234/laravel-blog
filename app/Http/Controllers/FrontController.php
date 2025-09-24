<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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

    public function about()
    {
        // Ambil repositori GitHub (misalnya username: johndoe)
        $username = 'Athallah1234';
        $response = Http::get("https://api.github.com/users/{$username}/repos");

        $repos = [];
        if ($response->successful()) {
            $repos = collect($response->json())
                ->sortByDesc('stargazers_count') // urutkan repo dengan stars terbanyak
                ->toArray();
        }

        return view('about', compact('repos'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function show($slug)
    {
        // Cari post berdasarkan slug
        $post = Post::where('slug', $slug)
            ->where('status', 'published')
            ->whereDate('publish_date', '<=', now())
            ->firstOrFail();

        // Generate TOC
        $toc = [];
        $content = $post->content;

        // Gunakan DOMDocument untuk parsing heading
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML('<?xml encoding="UTF-8">' . $content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $xpath = new \DOMXPath($dom);
        $headings = $xpath->query('//h2 | //h3 | //h4');

        foreach ($headings as $index => $heading) {
            $text = $heading->textContent;
            $id = 'heading-' . $index;

            // Tambahkan id ke heading agar bisa diklik dari TOC
            $heading->setAttribute('id', $id);

            $toc[] = [
                'tag' => $heading->nodeName,
                'text' => $text,
                'id' => $id,
            ];
        }

        // Update konten post dengan heading yang sudah ada ID
        $post->content = $dom->saveHTML();

        return view('show', compact('post', 'toc'));
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
