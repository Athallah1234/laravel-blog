<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use App\Models\Log;
use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $postCount = Post::count();
        $categoryCount = Category::count();
        $tagCount = Tag::count();

        $latestUsers = User::latest()->take(5)->get();

        // Ambil 5 post terbaru beserta relasinya
        $recentPosts = Post::with(['user', 'category'])
                           ->latest()
                           ->take(5)
                           ->get();
        
        // Ambil 6 bulan terakhir
        $months = collect(range(0, 5))->map(function ($i) {
            return Carbon::now()->subMonths($i)->format('M Y');
        })->reverse()->values();

        // Hitung post per bulan
        $postsData = collect(range(0, 5))->map(function ($i) {
            $date = Carbon::now()->subMonths($i);
            return Post::whereYear('created_at', $date->year)
                       ->whereMonth('created_at', $date->month)
                       ->count();
        })->reverse()->values();

        // Hitung user per bulan
        $usersData = collect(range(0, 5))->map(function ($i) {
            $date = Carbon::now()->subMonths($i);
            return User::whereYear('created_at', $date->year)
                       ->whereMonth('created_at', $date->month)
                       ->count();
        })->reverse()->values();

        return view('dashboard.index', compact(
            'userCount', 
            'postCount', 
            'categoryCount', 
            'tagCount', 
            'latestUsers',
            'recentPosts',
            'months',
            'postsData',
            'usersData',
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
                  ->orWhere('device', 'like', "%{$request->search}%");
            });
        }

        // Filter action
        if ($request->filter) {
            $query->where('action', $request->filter);
        }

        $logs = $query->orderByDesc('created_at')->paginate(10);
        $logs->appends($request->only(['search','filter']));

        return view('dashboard.logs', compact('logs'));
    }
}
