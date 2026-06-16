@extends('layouts.site')

@section('title', 'SophData | Soluções de Tecnologia para Você')
@section('meta_description',
    'Soluções de tecnologia para computador lento, Wi-Fi ruim, proteção de contas, arquivos,
    estudos, IA e montagem de PCs.')

@section('content')
    @php
        $whatsappUrl = sophdata_whatsapp_url('Olá, quero atendimento para uma necessidade pessoal.');
        $problemOrder = [
            'Meu computador está lento',
            'Meu Wi-Fi está ruim',
            'Quero proteger meus arquivos',
            'Preciso organizar estudos ou carreira',
            'Quero montar ou melhorar meu PC',
        ];
        $problemsByTitle = collect($problemCards)->keyBy('title');
        $featuredProblems = collect($problemOrder)->map(fn(string $title) => $problemsByTitle->get($title))->filter();
        $categoriesBySlug = collect($categories)->keyBy('slug');
        $featuredHeroServices = collect(['wifi-e-casa-conectada', 'montagem-e-upgrade-de-pc'])
            ->map(fn(string $slug) => $categoriesBySlug->get($slug))
            ->filter();
        $heroSlides = $featuredHeroServices
            ->map(
                fn(array $service) => [
                    'eyebrow' => 'Portal Para Você',
                    'title' => $service['title'],
                    'subtitle' => $service['description'],
                    'primaryButtonText' => 'Ver pacotes',
                    'primaryButtonUrl' => route('portal.personal.category', $service['slug']),
                    'secondaryButtonText' => $portal['primary_cta'],
                    'secondaryButtonUrl' => $whatsappUrl,
                    'image' => $service['hero_image'],
                    'imageAlt' => 'Solução pessoal de ' . $service['title'],
                ],
            )
            ->values()
            ->all();
        $packageLevels = [
            [
                'title' => 'Essencial',
                'positioning' => 'Para começar',
                'description' => 'Resolve a necessidade principal com orientação clara e uma entrega objetiva.',
                'items' => ['Problema prioritário', 'Configuração necessária', 'Orientação simples'],
                'featured' => false,
            ],
            [
                'title' => 'Profissional',
                'positioning' => 'Recomendado',
                'description' => 'Inclui o nível Essencial e acrescenta organização, segurança e acompanhamento.',
                'items' => ['Tudo do Essencial', 'Melhorias adicionais', 'Acompanhamento após a entrega'],
                'featured' => true,
            ],
            [
                'title' => 'Completo',
                'positioning' => 'Solução completa',
                'description' => 'Amplia o nível Profissional com prevenção, organização e suporte mais abrangente.',
                'items' => ['Tudo do Profissional', 'Prevenção e continuidade', 'Suporte ampliado'],
                'featured' => false,
            ],
        ];
        $audiences = [
            'Famílias',
            'Estudantes',
            'Profissionais autônomos',
            'Pessoas em home office',
            'Usuários que precisam de suporte',
            'Pessoas que querem melhorar seu computador',
        ];
        $reasons = [
            'Atendimento didático',
            'Ajuda para quem não entende termos técnicos',
            'Organização de computador e arquivos',
            'Segurança de contas e dados',
            'Atendimento remoto e presencial sob consulta',
        ];
        $technologies = [
            'Informática',
            'Redes',
            'Backup',
            'Segurança Digital',
            'IA',
            'Produtividade',
            'Montagem de Computadores',
        ];
    @endphp

    <x-site.hero-banner eyebrow="Portal Para Você" :title="$portal['title']" :subtitle="$portal['subtitle']" :primary-button-text="$portal['primary_cta']" :primary-button-url="$whatsappUrl"
        :secondary-button-text="$portal['secondary_cta']" secondary-button-url="#packages" :image="$portal['image']"
        image-alt="Soluções de tecnologia para o dia a dia" :slides="$heroSlides" variant="light" />

    <section id="solutions" class="scroll-mt-48 bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Qual solução você precisa?" title="O que você precisa resolver hoje?"
                description="Escolha o problema mais próximo da sua necessidade e encontre a solução adequada." centered />
            <div class="swiper sd_problems">
                <div class="swiper-wrapper my-12">
                    @foreach ($featuredProblems as $card)
                        <x-site.category-card :title="$card['title']" :description="$card['description']" :image="$card['image']" :url="route('portal.personal.category', $card['target_category_slug'])"
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
            <x-site.section-heading eyebrow="Categorias pessoais" title="Soluções organizadas por área"
                description="Escolha a solução mais próxima do seu problema e veja os pacotes." centered />
            <div class="swiper sd_solutions">
                <div class="mt-12 swiper-wrapper my-12">
                    @foreach ($categories as $category)
                        <x-site.category-card :title="$category['title']" :description="$category['short_description']" :image="$category['image']" :url="route('portal.personal.category', $category['slug'])"
                            :items="array_slice($category['benefits'], 0, 3)" cta-label="Ver pacotes" />
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>

    <section id="packages" class="scroll-mt-48 bg-white py-16 sm:py-20 lg:py-24">
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
            <x-site.section-heading eyebrow="Perfis atendidos" title="Para quem é?"
                description="Atendimento para quem quer resolver dificuldades e usar a tecnologia com mais confiança."
                centered />
            <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($audiences as $audience)
                    <article
                        class="rounded-2xl border border-slate-200 bg-white p-5 text-center font-bold text-brand-950 shadow-sm">
                        {{ $audience }}
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Diferenciais" title="Por que contratar a SophData?"
                description="Orientação próxima para resolver o problema sem transformar tecnologia em complicação."
                centered />
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

    <x-site.cta-section title="Quer resolver um problema de tecnologia sem complicação?"
        description="Inicie o atendimento e escolha o pacote mais adequado para sua necessidade."
        button-text="Quero atendimento" :button-url="$whatsappUrl" :image="config('sophdata.images.banner')" image-alt="Atendimento pessoal SophData" />

    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Experiência prática" title="Tecnologias e áreas"
                description="Computador, Wi-Fi, backup, segurança, estudos, carreira, IA e montagem de PC." centered />
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

    <!-- Initialize Swiper -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>

@endsection
