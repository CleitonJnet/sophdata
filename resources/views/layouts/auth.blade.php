<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title ?? 'SophData' }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">
    <main class="flex min-h-screen items-center justify-center px-4 py-10">
        <div class="w-full max-w-md">
            <div class="mb-8 text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center justify-center gap-3 text-brand-950">
                    <img src="{{ asset(config('sophdata.logos.symbol', 'favicon.svg')) }}" alt="" class="h-10 w-10">
                    <span class="text-2xl font-black tracking-tight">SophData</span>
                </a>
                <p class="mt-3 text-sm text-slate-600">Acesso do cliente</p>
            </div>

            <section class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
                {{ $slot }}
            </section>

            <p class="mt-6 text-center text-sm text-slate-600">
                <a href="{{ route('portal.business') }}" class="font-semibold text-brand-700 hover:text-brand-900">
                    Voltar para o site
                </a>
            </p>
        </div>
    </main>

    @livewireScripts
</body>

</html>
