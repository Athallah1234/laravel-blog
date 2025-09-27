<?php

namespace App\Listeners;

use App\Models\Log;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogUserLogin
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        Log::create([
            'user_id'       => $event->user->id,
            'action'        => 'login',
            'ip_address'    => Request::ip(),
            'device_browser'=> Request::header('User-Agent'),
            'logged_at'     => now(),
        ]);
    }
}
