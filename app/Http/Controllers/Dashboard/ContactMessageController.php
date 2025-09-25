<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\Controller;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('dashboard.contact_messages.index', compact('messages'));
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
