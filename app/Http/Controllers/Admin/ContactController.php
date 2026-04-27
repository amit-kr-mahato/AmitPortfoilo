<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $messages = Contact::latest()->get();
        $unreadCount = Contact::where('is_read', false)->count();

        return view('admin.email.index', compact('messages', 'unreadCount'));
    }

    public function show($id)
    {
        $message = Contact::findOrFail($id);

        $message->update(['is_read' => true]);

        return view('admin.email.show', compact('message'));
    }
}