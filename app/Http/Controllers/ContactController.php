<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
    
        Mail::send('emails.contact', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'messageContent' => $validated['message'],
        ], function ($message) use ($validated) {
            $message->to('admin@ruang-solusi.com')
                    ->subject('📩 Pesan Baru dari Website Ruang Solusi')
                    ->from('info@ruang-solusi.com', $validated['name'])
                    ->replyTo($validated['email'], $validated['name']);
        });
    
        return back()->with('success', 'Pesan berhasil dikirim! Terima kasih telah menghubungi kami.');
    }
}
