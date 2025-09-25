<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $postCount = Post::count();
        $categoryCount = Category::count();
        $tagCount = Tag::count();

        // Ambil 5 post terbaru beserta relasinya
        $recentPosts = Post::with(['author', 'category'])
                           ->latest()
                           ->take(5)
                           ->get();

        $postsMonthly = Post::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                            ->groupBy('month')
                            ->pluck('total', 'month')
                            ->all();

        $usersMonthly = User::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                            ->groupBy('month')
                            ->pluck('total', 'month')
                            ->all();

        return view('dashboard.index', compact(
            'userCount', 
            'postCount', 
            'categoryCount', 
            'tagCount', 
            'recentPosts', 
            'postsMonthly', 
            'usersMonthly'
        ));
    }

    public function settings()
    {
        return view('dashboard.settings');
    }

    public function logs(Request $request)
    {
        $query = Log::with('user');

        // Filter pencarian
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('action', 'like', "%{$request->search}%")
                  ->orWhere('ip_address', 'like', "%{$request->search}%")
                  ->orWhere('device_browser', 'like', "%{$request->search}%");
            });
        }

        // Filter action
        if ($request->filter) {
            $query->where('action', $request->filter);
        }

        $logs = $query->orderByDesc('logged_at')->paginate(10);
        return view('dashboard.logs', compact('logs'));
    }
}
