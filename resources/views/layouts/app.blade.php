<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title ?? 'Painel SophData' }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased">
    <header class="border-b border-slate-200 bg-white">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 font-black text-brand-950">
                <img src="{{ asset(config('sophdata.logos.symbol', 'favicon.svg')) }}" alt="" class="h-9 w-9">
                <span>SophData</span>
            </a>

            <nav class="flex items-center gap-4 text-sm">
                <a href="{{ route('portal.business') }}" class="font-semibold text-slate-600 hover:text-brand-800">
                    Site
                </a>
                <a href="{{ route('profile.edit') }}" class="font-semibold text-slate-600 hover:text-brand-800">
                    Perfil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-md bg-brand-950 px-4 py-2 font-semibold text-white hover:bg-brand-800">
                        Sair
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 py-10">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    @livewireScripts
</body>

</html>
