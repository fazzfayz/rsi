<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Inquiry;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'service_needed' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Save to database
        try {
            Inquiry::create([
                'name' => $validated['name'],
                'company' => $validated['company'] ?? null,
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'service_needed' => $validated['service_needed'] ?? null,
                'message' => $validated['message'],
                'is_read' => false,
            ]);
        } catch (\Throwable $e) {
            Log::error('Inquiry database save failed: ' . $e->getMessage());
        }
    
        // Send email notification
        try {
            Mail::send('emails.contact', [
                'name' => $validated['name'],
                'company' => $validated['company'] ?? '-',
                'phone' => $validated['phone'] ?? '-',
                'service_needed' => $validated['service_needed'] ?? '-',
                'email' => $validated['email'],
                'messageContent' => $validated['message'],
            ], function ($message) use ($validated) {
                $subject = '📩 Konsultasi / Inquiry Baru: ' . $validated['name'];
                if (!empty($validated['company'])) {
                    $subject .= ' (' . $validated['company'] . ')';
                }
                $message->to('admin@ruang-solusi.com')
                        ->subject($subject)
                        ->from('info@ruang-solusi.com', $validated['name'])
                        ->replyTo($validated['email'], $validated['name']);
            });
        } catch (\Throwable $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
        }
    
        // Return JSON response for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Permintaan konsultasi Anda telah berhasil terkirim! Tim spesialis IT kami akan menghubungi Anda segera.'
            ]);
        }
    
        return back()->with('success', 'Permintaan konsultasi Anda telah berhasil terkirim! Tim spesialis IT kami akan menghubungi Anda segera.');
    }

    /**
     * Inquiry dari halaman detail layanan (Managed Service, Web & Software Development, dll.).
     */
    public function sendServiceInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
            'service_title' => 'nullable|string|max:255',
            'inquiry_source' => 'required|string|in:managed_service,web_software_development,infrastruktur_teknologi',
        ]);

        $typeLabels = [
            'managed_service' => 'Managed Service',
            'web_software_development' => 'Web & Software Development',
            'infrastruktur_teknologi' => 'Technology Infrastructure',
        ];
        $typeLabel = $typeLabels[$validated['inquiry_source']] ?? 'Service';

        try {
            Mail::send('emails.contact', [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'messageContent' => $validated['message'],
                'serviceTitle' => $validated['service_title'] ?? null,
                'inquiryTypeLabel' => $typeLabel,
            ], function ($message) use ($validated, $typeLabel) {
                $subject = $typeLabel . ' — Inquiry';
                if (! empty($validated['service_title'])) {
                    $subject .= ': ' . $validated['service_title'];
                }
                $message->to('admin@ruang-solusi.com')
                    ->subject('📋 ' . $subject)
                    ->from('info@ruang-solusi.com', $validated['name'])
                    ->replyTo($validated['email'], $validated['name']);
            });
        } catch (\Exception $e) {
            \Log::error('Service inquiry email failed: ' . $e->getMessage());
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Your request has been sent. Our team will get back to you.',
            ]);
        }

        return back()->with('success', 'Your request has been sent. Our team will get back to you.');
    }
}
