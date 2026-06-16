@extends('layouts.site')

@section('title', 'Escolha seu Perfil | SophData')
@section('meta_description', 'Escolha entre o portal Para Empresas e o portal Para Você da SophData.')

@section('content')
    @php
        $profiles = [
            [
                'title' => 'Para Empresas',
                'description' => 'Suporte, redes e Wi-Fi, segurança, backup, sites, sistemas, automação e computadores para pequenos negócios e instituições.',
                'image' => 'https://placehold.co/640x360/0B1F4D/FFFFFF?text=Para+Empresas',
                'button' => 'Acessar portal empresarial',
                'url' => route('portal.business'),
            ],
            [
                'title' => 'Para Você',
                'description' => 'Suporte para computador, internet, segurança digital, estudos, carreira, produtividade e montagem de PCs.',
                'image' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Para+Voce',
                'button' => 'Acessar portal pessoal',
                'url' => route('portal.personal'),
            ],
        ];
    @endphp

    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6">
            <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-600">Escolher perfil</p>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-brand-950 sm:text-5xl">Como você deseja navegar?</h1>
            <p class="mx-auto mt-5 max-w-2xl text-lg leading-8 text-slate-600">
                Escolha o perfil mais adequado para encontrar as soluções certas da SophData.
            </p>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-6xl gap-6 px-4 sm:px-6 md:grid-cols-2 lg:px-8">
            @foreach ($profiles as $profile)
                <article class="card-lift flex h-full flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                    <figure>
                        <img src="{{ $profile['image'] }}" alt="{{ $profile['title'] }}" class="aspect-video w-full object-cover" loading="lazy" decoding="async">
                    </figure>
                    <div class="flex flex-1 flex-col p-7">
                        <h2 class="text-2xl font-bold text-brand-950">{{ $profile['title'] }}</h2>
                        <p class="mt-4 leading-7 text-slate-600">{{ $profile['description'] }}</p>
                        <a href="{{ $profile['url'] }}" class="mt-7 inline-flex min-h-12 items-center justify-center rounded-full bg-action-500 px-6 py-3 text-center text-sm font-bold text-white hover:bg-action-600">
                            {{ $profile['button'] }}
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
