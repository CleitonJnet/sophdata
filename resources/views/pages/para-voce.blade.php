@extends('layouts.site')

@section('title', 'Para Você | SophData')
@section('meta_description', 'Suporte para computador, internet, segurança digital, estudos, produtividade e montagem de computadores para pessoas físicas.')

@section('content')
    @php
        $categories = config('sophdata.categories.personal');
        $whatsappNumber = config('sophdata.brand.whatsapp');
        $whatsappUrl = sophdata_whatsapp_url('Olá, gostaria de atendimento para pessoa física.');
        $categoryLabels = [
            'Suporte',
            'Casa Conectada',
            'Proteção',
            'Estudos',
            'IA',
            'Montagem de PCs',
        ];
        $differentials = [
            'Atendimento claro',
            'Ajuda para quem não entende termos técnicos',
            'Organização do computador e arquivos',
            'Segurança de contas e dados',
            'Atendimento remoto e presencial sob consulta',
        ];
    @endphp

    <x-site.hero-banner
        eyebrow="Para Você"
        title="Soluções de tecnologia para o seu dia a dia"
        subtitle="Suporte para computador, internet, segurança digital, estudos, carreira, produtividade e montagem de PCs com atendimento claro e objetivo."
        primary-button-text="Falar no WhatsApp"
        :primary-button-url="$whatsappUrl"
        secondary-button-text="Ver pacotes"
        :secondary-button-url="'#'.$categories[0]['slug']"
        image="https://placehold.co/720x520/0B1F4D/FFFFFF?text=Tecnologia+Para+Voce"
    />

    <nav class="sticky top-18 z-30 border-y border-slate-200 bg-white/95 shadow-sm backdrop-blur lg:top-40" aria-label="Categorias para você">
        <div class="horizontal-scroll mx-auto flex max-w-7xl gap-2 overflow-x-auto px-4 py-3 sm:px-6 lg:justify-center lg:px-8">
            @foreach ($categories as $category)
                <a
                    href="#{{ $category['slug'] }}"
                    class="inline-flex min-h-11 shrink-0 items-center rounded-full border border-brand-100 bg-brand-50 px-5 py-2 text-sm font-bold text-brand-700 transition hover:border-brand-600 hover:bg-brand-600 hover:text-white"
                >
                    {{ $categoryLabels[$loop->index] }}
                </a>
            @endforeach
        </div>
    </nav>

    <section class="bg-white py-16 sm:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading
                eyebrow="Categorias de atendimento"
                title="Escolha o que você precisa resolver"
                description="Cada categoria possui três níveis de pacote para combinar urgência, organização e acompanhamento."
                centered
            />
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($categories as $category)
                    <x-site.category-card
                        :title="$category['title']"
                        :description="$category['short_description']"
                        :image="$category['image']"
                        :url="'#'.$category['slug']"
                        :items="[$category['eyebrow']]"
                    />
                @endforeach
            </div>
        </div>
    </section>

    @foreach ($categories as $category)
        <section
            id="{{ $category['slug'] }}"
            @class([
                'scroll-mt-52 py-16 sm:py-20 lg:py-24',
                'bg-brand-50' => $loop->odd,
                'bg-white' => $loop->even,
            ])
        >
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="relative overflow-hidden rounded-[2rem] bg-brand-950 text-white shadow-xl">
                    <img
                        src="{{ $category['image'] }}"
                        alt="{{ $category['title'] }}"
                        class="absolute inset-0 h-full w-full object-cover opacity-30"
                        loading="lazy"
                    >
                    <div class="hero-grid relative max-w-3xl px-7 py-10 sm:px-10 sm:py-12">
                        <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-300">{{ $category['eyebrow'] }}</p>
                        <h2 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">{{ $category['title'] }}</h2>
                        <p class="mt-4 text-lg leading-8 text-brand-100/80">{{ $category['short_description'] }}</p>
                    </div>
                </div>

                <div class="mt-12 grid items-stretch gap-6 lg:grid-cols-3">
                    @foreach ($category['packages'] as $package)
                        <x-site.package-card :package="$package" :whatsapp-number="$whatsappNumber" />
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading
                eyebrow="Diferenciais para você"
                title="Ajuda técnica sem linguagem complicada"
                description="Orientação próxima para resolver o problema e ajudar você a usar a tecnologia com mais confiança."
                centered
            />
            <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-5">
                @foreach ($differentials as $differential)
                    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <span class="grid size-11 place-items-center rounded-2xl bg-brand-100 text-sm font-bold text-brand-700">
                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <h3 class="mt-6 text-lg font-bold leading-7 text-brand-950">{{ $differential }}</h3>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta-section
        title="Quer resolver um problema de tecnologia sem complicação?"
        description="Fale com a SophData pelo WhatsApp e escolha o pacote mais adequado para sua necessidade."
        button-text="Falar no WhatsApp"
        :button-url="$whatsappUrl"
        image="https://placehold.co/1200x360/F3F6FA/0B1F4D?text=Atendimento+Para+Voce"
    />
@endsection
