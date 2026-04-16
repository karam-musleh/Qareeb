<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request)
    {
        $contact = ContactMessage::create($request->validated());
        Mail::to('karammusleh74@gmail.com')->send(new \App\Mail\ContactUsMail($contact));

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $contact
        ], 201);
    }

    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);

        return response()->json($messages);
    }

    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);

        return response()->json($message);
    }

    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['is_read' => true]);

        return response()->json([
            'message' => 'Marked as read'
        ]);
    }

    public function destroy($id)
    {
        ContactMessage::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }
}
