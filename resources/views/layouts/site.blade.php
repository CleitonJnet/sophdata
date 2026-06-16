<!DOCTYPE html>
<html lang="pt-BR">

<head>
    @php
        $seoTitle = trim($__env->yieldContent('title', config('sophdata.brand.name')));
        $seoDescription = trim(
            $__env->yieldContent('meta_description', 'Soluções de tecnologia para pessoas e empresas.'),
        );
        $logoPath = config('sophdata.logos.symbol', 'favicon.svg');
        $logoUrl = asset($logoPath);
    @endphp

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $seoDescription }}">
    <meta name="robots" content="index, follow">

    <title>{{ $seoTitle }}</title>
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seoTitle }}">
    <meta property="og:image" content="{{ $logoUrl }}">
    <meta property="og:description" content="{{ $seoDescription }}">
    <meta property="og:site_name" content="{{ config('sophdata.brand.name') }}">
    <meta property="og:locale" content="pt_BR">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="{{ $seoTitle }}">
    <meta name="twitter:description" content="{{ $seoDescription }}">
    <meta name="twitter:image" content="{{ $logoUrl }}">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="mask-icon" href="{{ asset('favicon.svg') }}" color="#0B1F4D">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-slate-900 antialiased">
    <a href="#main-content" class="skip-link">Ir para o conteúdo principal</a>

    <x-site.header />

    <main id="main-content" tabindex="-1">
        @yield('content')
    </main>

    <x-site.footer />
    <x-site.whatsapp-floating />
</body>

</html>
