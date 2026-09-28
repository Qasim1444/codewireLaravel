@php($site = \App\Support\SiteData::site())
Hello {{ $contact->name }},

Thanks for reaching out to CodeWire Solutions. We have received your message and our team will get back to you within one business day.

Here is a summary of what you sent:

@isset($contact->subject)
Subject: {{ $contact->subject }}
@endisset
@isset($contact->company)
Company: {{ $contact->company }}
@endisset
@isset($contact->phone)
Phone / WhatsApp: {{ $contact->phone }}
@endisset

Message:
{{ $contact->message }}

If you need to add anything, simply reply to this email.

—
The CodeWire Solutions team
{{ $site['contact']['email'] ?? config('mail.from.address') }}