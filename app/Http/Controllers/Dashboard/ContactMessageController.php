<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class ContactMessageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $messages = ContactMessage::when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")
                    ->orWhere('message', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10);

        // biar query search ikut ke pagination
        $messages->appends(['search' => $search]);

        return view('dashboard.contact_messages.index', compact('messages', 'search'));
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        // Jika pesan belum dibaca, tandai sebagai sudah dibaca
        if (!$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('dashboard.contact_messages.show', compact('message'));
    }
}
