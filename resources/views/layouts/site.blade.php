<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="@yield('meta_description', 'Soluções de tecnologia para pessoas e empresas.')">
        <meta name="robots" content="index, follow">

        <title>@yield('title', config('sophdata.brand.name'))</title>
        <link rel="canonical" href="{{ url()->current() }}">

        <link rel="icon" href="/favicon.svg" type="image/svg+xml">

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <a href="#conteudo-principal" class="skip-link">Ir para o conteúdo principal</a>

        <x-site.header />

        <main id="conteudo-principal" tabindex="-1">
            @yield('content')
        </main>

        <x-site.footer />
        <x-site.whatsapp-floating />
    </body>
</html>
