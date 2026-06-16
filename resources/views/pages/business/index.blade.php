@extends('layouts.site')

@section('title', 'SophData | Soluções de TI para Empresas')
@section('meta_description',
    'Soluções de TI para empresas com suporte, redes, backup, sites, sistemas e automação para
    resolver paradas, Wi-Fi instável e planilhas demais.')

@section('content')
    @php
        $whatsappUrl = sophdata_whatsapp_url('Olá, quero solicitar atendimento empresarial.');
        $problemOrder = [
            'Computadores parando?',
            'Internet ou Wi-Fi instável?',
            'Sua empresa não tem backup?',
            'Precisa de site ou sistema?',
            'Usa planilhas demais?',
            'Precisa renovar os computadores?',
        ];
        $problemsByTitle = collect($problemCards)->keyBy('title');
        $featuredProblems = collect($problemOrder)->map(fn(string $title) => $problemsByTitle->get($title))->filter();
        $packageLevels = [
            [
                'title' => 'Essencial',
                'positioning' => 'Para começar',
                'description' => 'Resolve a necessidade principal com um escopo direto e adequado para começar.',
                'items' => ['Problema prioritário', 'Entrega objetiva', 'Orientações de uso'],
                'featured' => false,
            ],
            [
                'title' => 'Profissional',
                'positioning' => 'Recomendado',
                'description' => 'Inclui o nível Essencial e acrescenta organização, segurança e acompanhamento.',
                'items' => ['Tudo do Essencial', 'Melhorias estruturadas', 'Acompanhamento após a entrega'],
                'featured' => true,
            ],
            [
                'title' => 'Completo',
                'positioning' => 'Solução completa',
                'description' => 'Amplia o nível Profissional com prevenção, documentação e visão de continuidade.',
                'items' => ['Tudo do Profissional', 'Prevenção e documentação', 'Suporte ampliado'],
                'featured' => false,
            ],
        ];
        $businessTypes = [
            'Igrejas',
            'Escolas',
            'Escritórios',
            'Consultórios',
            'Lojas',
            'Prestadores de serviço',
            'Pequenas empresas',
            'Instituições',
        ];
        $reasons = [
            'Atendimento claro e didático',
            'Experiência com suporte, redes e sistemas',
            'Soluções sob medida',
            'Foco em prevenção e organização',
            'Atendimento remoto e presencial sob consulta',
            'Explicação simples, sem linguagem confusa',
        ];
        $technologies = [
            'Linux',
            'Laravel',
            'PHP',
            'MySQL',
            'PostgreSQL',
            'Java',
            'Spring Boot',
            'Redes',
            'Backup',
            'Segurança Digital',
            'Montagem de Computadores',
        ];
    @endphp

    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />

    <x-site.hero-banner eyebrow="Portal Para Empresas" :title="$portal['title']" :subtitle="$portal['subtitle']" :primary-button-text="$portal['primary_cta']"
        :primary-button-url="$whatsappUrl" :secondary-button-text="$portal['secondary_cta']" secondary-button-url="#solutions" :image="$portal['image']"
        image-alt="Soluções de tecnologia para empresas" />

    <section id="solutions" class="scroll-mt-48 bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Qual solução sua empresa precisa?" title="O que sua empresa precisa resolver?"
                description="Escolha o problema mais próximo da sua realidade e veja a solução indicada." centered />
            <div class="swiper sd_problems">
                <div class="swiper-wrapper my-12">
                    @foreach ($featuredProblems as $card)
                        <x-site.category-card :title="$card['title']" :description="$card['description']" :image="$card['image']" :url="route('portal.business.category', $card['target_category_slug'])"
                            :cta-label="$card['cta_label']" />
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Categorias empresariais" title="Soluções organizadas por área"
                description="Escolha a área do problema e compare os pacotes disponíveis." centered />
            <div class="swiper sd_solutions">
                <div class="mt-12 swiper-wrapper my-12">
                    @foreach ($categories as $category)
                        <x-site.category-card :title="$category['title']" :description="$category['short_description']" :image="$category['image']" :url="route('portal.business.category', $category['slug'])"
                            :items="array_slice($category['benefits'], 0, 3)" cta-label="Conhecer serviço" />
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Progressão comercial" title="Escolha o nível de atendimento ideal"
                description="Cada categoria oferece três níveis progressivos. Os detalhes completos ficam na página de cada solução."
                centered />
            <div class="mt-12 grid items-stretch gap-6 lg:grid-cols-3">
                @foreach ($packageLevels as $level)
                    <x-site.portal-level-card :level="$level" />
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Perfis atendidos" title="Para quais negócios?"
                description="Atendimento para rotinas reais de pequenos negócios, equipes e instituições." centered />
            <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($businessTypes as $businessType)
                    <article
                        class="rounded-2xl border border-slate-200 bg-white p-5 text-center font-bold text-brand-950 shadow-sm">
                        {{ $businessType }}
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Diferenciais" title="Por que contratar a SophData?"
                description="Correção de problemas, organização da rotina e orientação em linguagem simples." centered />
            <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($reasons as $reason)
                    <article class="flex gap-4 rounded-3xl border border-slate-200 bg-slate-50 p-6">
                        <span
                            class="grid size-10 shrink-0 place-items-center rounded-full bg-brand-100 font-bold text-brand-700"
                            aria-hidden="true">✓</span>
                        <h3 class="font-bold leading-7 text-brand-950">{{ $reason }}</h3>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Experiência técnica" title="Tecnologias e áreas"
                description="Suporte, redes, backup, sites, sistemas, dados e computadores para a rotina da empresa."
                centered />
            <div class="mt-10 flex flex-wrap justify-center gap-3">
                @foreach ($technologies as $technology)
                    <span
                        class="rounded-full border border-brand-200 bg-white px-5 py-3 text-sm font-bold text-brand-800 shadow-sm">
                        {{ $technology }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta-section title="Sua empresa precisa de uma TI mais organizada?"
        description="Inicie o atendimento e solicite orientação para encontrar o pacote ideal."
        button-text="Solicitar atendimento empresarial" :button-url="$whatsappUrl" :image="config('sophdata.images.banner')"
        image-alt="Atendimento empresarial SophData" />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".sd_problems", {
            slidesPerView: 1.1,
            spaceBetween: 10,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                540: {
                    slidesPerView: 2.1,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 3.1,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 4.1,
                    spaceBetween: 20,
                },
            },

        });

        var swiper = new Swiper(".sd_solutions", {
            slidesPerView: 1,
            spaceBetween: 10,
            grabCursor: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                540: {
                    slidesPerView: 2.1,
                    spaceBetween: 15,
                },
                768: {
                    slidesPerView: 3.1,
                    spaceBetween: 15,
                },
                1024: {
                    slidesPerView: 4.1,
                    spaceBetween: 20,
                },
            },
        });
    </script>

@endsection
