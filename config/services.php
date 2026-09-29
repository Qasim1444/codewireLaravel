<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'meta' => [
        // Pixel / Dataset ID - public, safe to render in the browser.
        'pixel_id' => env('META_PIXEL_ID'),

        // Conversions API access token - server-side only, never exposed to the frontend.
        'capi_access_token' => env('META_CAPI_ACCESS_TOKEN'),

        'graph_version' => env('META_GRAPH_VERSION', 'v26.0'),

        // Only set while validating in Events Manager > Test Events.
        'test_event_code' => env('META_TEST_EVENT_CODE'),

        // Send inline by default so Test Events appear immediately. Set true
        // only when a queue worker is running continuously.
        'queue' => env('META_CAPI_QUEUE', false),

        // Require marketing consent before any pixel/CAPI tracking happens.
        'require_consent' => env('META_REQUIRE_CONSENT', true),
    ],

];
