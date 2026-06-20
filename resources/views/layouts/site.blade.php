<!DOCTYPE html>
<html lang="pt-BR">

<head>
    @php
        $seo = is_array($seo ?? null) ? $seo : [];
        $indexable = (bool) config('sophdata.seo.indexable', false);
        $seoTitle = trim($seo['title'] ?? $__env->yieldContent('title', config('sophdata.seo.default_title', config('sophdata.brand.name'))));
        $seoDescription = trim($seo['description'] ?? $__env->yieldContent('meta_description', config('sophdata.seo.default_description', 'Soluções de tecnologia para pessoas e empresas.')));
        $seoCanonical = $seo['canonical'] ?? null;
        $seoCanonicalUrl = $seoCanonical
            ? (str_starts_with($seoCanonical, 'http://') || str_starts_with($seoCanonical, 'https://')
                ? $seoCanonical
                : url($seoCanonical))
            : url()->current();
        $seoOgTitle = $seo['og_title'] ?? $seoTitle;
        $seoOgDescription = $seo['og_description'] ?? $seoDescription;
        $seoRobots = $indexable ? ($seo['robots'] ?? 'index, follow') : 'noindex, nofollow';
        $logoPath = config('sophdata.logos.symbol', 'favicon.svg');
        $logoUrl = asset($logoPath);
        $ogImagePath = $seo['og_image'] ?? config('sophdata.seo.default_og_image');
        if ($ogImagePath && ! str_starts_with($ogImagePath, 'http://') && ! str_starts_with($ogImagePath, 'https://') && ! file_exists(public_path(ltrim($ogImagePath, '/')))) {
            $ogImagePath = config('sophdata.seo.default_og_image', 'img/sophdata/portals/business-hero.webp');
        }
        $ogImageUrl = $ogImagePath
            ? (str_starts_with($ogImagePath, 'http://') || str_starts_with($ogImagePath, 'https://')
                ? $ogImagePath
                : asset($ogImagePath))
            : $logoUrl;
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="{{ $seoRobots }}">

    <title>{{ $seoTitle }}</title>
    <link rel="canonical" href="{{ $seoCanonicalUrl }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ $seoCanonicalUrl }}">
    <meta property="og:title" content="{{ $seoOgTitle }}">
    <meta property="og:image" content="{{ $ogImageUrl }}">
    <meta property="og:description" content="{{ $seoOgDescription }}">
    <meta property="og:site_name" content="{{ config('sophdata.brand.name') }}">
    <meta property="og:locale" content="pt_BR">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $seoOgTitle }}">
    <meta name="twitter:description" content="{{ $seoOgDescription }}">
    <meta name="twitter:image" content="{{ $ogImageUrl }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="mask-icon" href="{{ asset('favicon.svg') }}" color="#0B1F4D">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-slate-900 antialiased relative">
    <a href="#main-content" class="skip-link">Ir para o conteúdo principal</a>

    <x-site.header />

    <main id="main-content" tabindex="-1">
        @yield('content')
    </main>

    <x-site.footer />
    <x-site.whatsapp-floating />
    <x-site.profile-gate-modal background="img/sophdata/cta/contact-banner.webp" />

</body>

</html>
