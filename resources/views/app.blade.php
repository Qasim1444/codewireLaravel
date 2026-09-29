<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title inertia>CodeWire Solutions</title>

    @if ($pixelId = config('services.meta.pixel_id'))
        {{-- Meta Pixel base code. The loader is defined here but is only invoked
             by resources/js/meta-pixel.js once marketing consent is granted. --}}
        <script>
            window.__META_PIXEL_ID__ = @json($pixelId);
            window.__META_REQUIRE_CONSENT__ = @json((bool) config('services.meta.require_consent', true));
            window.__loadMetaPixel__ = function () {
                if (window.fbq) return;
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window, document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', window.__META_PIXEL_ID__);
            };
        </script>

        @unless (config('services.meta.require_consent', true))
            {{-- Only rendered when consent is not required; a <noscript> pixel
                 cannot be gated behind a consent choice. --}}
            <noscript>
                <img height="1" width="1" style="display:none" alt=""
                     src="https://www.facebook.com/tr?id={{ $pixelId }}&ev=PageView&noscript=1">
            </noscript>
        @endunless
    @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
</head>
<body>
    @inertia
</body>
</html>
