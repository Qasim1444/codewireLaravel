<?php

namespace App\Support;

use Illuminate\Http\Request;

/**
 * Single source of truth for "may we run marketing tracking for this visitor?".
 *
 * The browser stores the visitor's choice in the `cw_consent` cookie (JSON,
 * written by resources/js/consent.js) and mirrors it on tracked form requests
 * via the `marketing_consent` field. Either signal is enough to grant consent;
 * absence of both means "not granted".
 */
class MarketingConsent
{
    public const COOKIE = 'cw_consent';

    /**
     * Is marketing tracking permitted for the current request?
     */
    public static function granted(Request $request): bool
    {
        if (! config('services.meta.require_consent', true)) {
            return true;
        }

        $explicit = $request->input('marketing_consent');

        if ($explicit !== null) {
            return filter_var($explicit, FILTER_VALIDATE_BOOLEAN);
        }

        return static::fromCookie($request);
    }

    /**
     * Read the marketing flag out of the consent cookie.
     */
    protected static function fromCookie(Request $request): bool
    {
        $raw = $request->cookie(static::COOKIE);

        if (! is_string($raw) || $raw === '') {
            return false;
        }

        $decoded = json_decode(rawurldecode($raw), true);

        if (! is_array($decoded)) {
            return false;
        }

        return filter_var($decoded['marketing'] ?? false, FILTER_VALIDATE_BOOLEAN);
    }
}
