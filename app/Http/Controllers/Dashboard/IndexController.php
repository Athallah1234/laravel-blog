<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
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
