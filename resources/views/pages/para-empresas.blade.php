@extends('layouts.site')

@section('title', 'Para Empresas | SophData')
@section('meta_description', 'Suporte de TI, redes, segurança, sites, sistemas, automação e consultoria para pequenos negócios e instituições.')

@section('content')
    @php
        $categories = config('sophdata.categories.business');
        $whatsappNumber = config('sophdata.brand.whatsapp');
        $whatsappUrl = sophdata_whatsapp_url('Olá, gostaria de solicitar um orçamento para minha empresa.');
        $categoryLabels = [
            'Suporte',
            'Redes',
            'Segurança',
            'Sites',
            'Sistemas',
            'Automação',
            'Servidores',
            'Consultoria',
            'Computadores',
        ];
        $quickActions = [
            ['label' => 'Suporte de TI', 'url' => '#suporte-de-ti'],
            ['label' => 'Redes e infraestrutura', 'url' => '#infraestrutura-e-redes'],
            ['label' => 'Segurança e backup', 'url' => '#seguranca-e-backup'],
            ['label' => 'Sites e sistemas', 'url' => '#sites-e-presenca-digital'],
            ['label' => 'Automação e dados', 'url' => '#automacao-e-dados'],
            ['label' => 'Solicitar orçamento', 'url' => $whatsappUrl, 'external' => true],
        ];
        $segments = [
            ['name' => 'Igrejas', 'description' => 'Organização de computadores, redes, transmissão e ferramentas administrativas.', 'initials' => 'IG'],
            ['name' => 'Escolas', 'description' => 'Suporte para equipes, laboratórios, conectividade e serviços digitais.', 'initials' => 'ES'],
            ['name' => 'Escritórios', 'description' => 'Ambientes produtivos, seguros e preparados para colaboração.', 'initials' => 'EC'],
            ['name' => 'Consultórios', 'description' => 'Tecnologia organizada para atendimento, agenda e proteção de dados.', 'initials' => 'CO'],
            ['name' => 'Lojas', 'description' => 'Suporte para operação, internet, equipamentos e presença digital.', 'initials' => 'LJ'],
            ['name' => 'Prestadores de serviço', 'description' => 'Ferramentas para ganhar produtividade e apresentar melhor o negócio.', 'initials' => 'PS'],
            ['name' => 'Pequenas empresas', 'description' => 'Estrutura de TI proporcional ao momento e ao crescimento da operação.', 'initials' => 'PE'],
            ['name' => 'Instituições', 'description' => 'Soluções para equipes, processos, comunicação e continuidade.', 'initials' => 'IN'],
        ];
        $consultingBenefits = [
            'Reduz problemas recorrentes',
            'Organiza computadores, redes e sistemas',
            'Melhora segurança e backup',
            'Evita perda de dados',
            'Ajuda a empresa a crescer com mais controle',
            'Permite atendimento recorrente',
        ];
    @endphp

    <x-site.hero-banner
        eyebrow="Para Empresas"
        title="Soluções de TI para pequenos negócios e instituições"
        subtitle="Suporte técnico, redes, segurança, sites, sistemas, automação, servidores, consultoria e renovação de computadores para manter sua operação funcionando com organização e confiança."
        primary-button-text="Solicitar orçamento"
        :primary-button-url="$whatsappUrl"
        secondary-button-text="Ver soluções"
        :secondary-button-url="'#'.$categories[0]['slug']"
        image="https://placehold.co/720x520/0B1F4D/FFFFFF?text=TI+Para+Empresas"
    />

    <x-site.quick-action-bar
        title="O que sua empresa precisa resolver?"
        :actions="$quickActions"
        class="-mt-7"
    />

    <nav class="sticky top-18 z-30 border-y border-slate-200 bg-white/95 shadow-sm backdrop-blur lg:top-40" aria-label="Categorias para empresas">
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
                eyebrow="Categorias comerciais"
                title="Uma estrutura de TI para cada prioridade"
                description="Escolha a área que sua empresa precisa organizar agora e compare três níveis progressivos de atendimento."
                centered
            />
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($categories as $category)
                    <x-site.offer-card
                        :title="$category['title']"
                        :description="$category['short_description']"
                        :image="$category['image']"
                        :url="'#'.$category['slug']"
                        button-text="Ver pacotes"
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
                eyebrow="Para quais negócios?"
                title="Tecnologia para operações enxutas e instituições"
                description="Soluções adaptadas ao tamanho, à equipe e ao ritmo de cada organização."
                centered
            />
            <img
                src="https://placehold.co/1200x360/F3F6FA/0B1F4D?text=Pequenos+Negocios+e+Instituicoes"
                alt="Pequenos negócios e instituições"
                class="mt-12 aspect-[10/3] w-full rounded-[2rem] object-cover shadow-lg"
                loading="lazy"
            >
            <div class="mt-8 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($segments as $segment)
                    <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <span class="grid size-12 place-items-center rounded-2xl bg-brand-100 text-sm font-black text-brand-700">
                            {{ $segment['initials'] }}
                        </span>
                        <h3 class="mt-5 text-xl font-bold text-brand-950">{{ $segment['name'] }}</h3>
                        <p class="mt-3 leading-7 text-slate-600">{{ $segment['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-[.85fr_1.15fr] lg:px-8">
            <div class="rounded-[2rem] bg-brand-950 p-8 text-white shadow-xl sm:p-10">
                <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-300">Consultoria de TI</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl">Por que contratar uma consultoria de TI?</h2>
                <p class="mt-5 leading-8 text-brand-100/75">
                    Uma visão externa e organizada ajuda a priorizar investimentos, reduzir riscos e evitar decisões improvisadas.
                </p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="mt-8 inline-flex min-h-12 items-center rounded-full bg-action-500 px-6 py-3 text-sm font-bold text-white transition hover:bg-action-600">
                    Solicitar diagnóstico
                </a>
            </div>
            <div class="grid gap-4 sm:grid-cols-2">
                @foreach ($consultingBenefits as $benefit)
                    <article class="flex gap-4 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                        <span class="grid size-9 shrink-0 place-items-center rounded-full bg-brand-100 font-bold text-brand-700">✓</span>
                        <h3 class="font-bold leading-7 text-brand-950">{{ $benefit }}</h3>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta-section
        title="Sua empresa precisa de uma TI mais organizada?"
        description="Fale pelo WhatsApp e solicite um diagnóstico inicial para encontrar o pacote ideal."
        button-text="Solicitar orçamento"
        :button-url="$whatsappUrl"
        image="https://placehold.co/1200x360/0B1F4D/FFFFFF?text=Solicite+um+Orcamento"
    />
@endsection
