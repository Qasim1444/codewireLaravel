<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Notifications\ContactReceived;
use App\Support\SiteData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class ContactController extends Controller
{
    /**
     * Show the contact page (Inertia view).
     */
    public function view()
    {
        return Inertia::render('ContactView', [
            'services' => SiteData::services(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'company' => ['nullable', 'string', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
            'source' => ['nullable', 'string', 'max:50'],
            'preferred_date' => ['nullable', 'string', 'max:50'],
            'preferred_time' => ['nullable', 'string', 'max:50'],
            'contact_method' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'string', 'max:255'], // honeypot
        ]);

        // Silently drop bots that filled the honeypot field.
        if (! empty($data['website'] ?? null)) {
            return response()->json(['ok' => true], 200);
        }

        $contact = Contact::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'] ?? null,
            'company' => $data['company'] ?? null,
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'],
            'source' => $data['source'] ?? 'website-contact-form',
            'preferred_date' => $data['preferred_date'] ?? null,
            'preferred_time' => $data['preferred_time'] ?? null,
            'contact_method' => $data['contact_method'] ?? null,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        try {
            $contact->notify(new ContactReceived($contact));
        } catch (\Throwable $e) {
            Log::error('Contact notification failed: '.$e->getMessage(), [
                'contact_id' => $contact->id,
                'exception' => $e,
            ]);
        }

        return response()->json(['ok' => true, 'id' => $contact->id], 201);
    }
}
