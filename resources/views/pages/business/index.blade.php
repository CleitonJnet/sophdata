@extends('layouts.site')

@section('title', 'SophData | Soluções de TI para Empresas')
@section('meta_description',
    'Suporte de TI, redes, segurança, backup, sites, sistemas, automação e computadores
    corporativos para pequenos negócios e instituições.')

@section('content')
    @php
        /** @var array $portal */
        $whatsappUrl = sophdata_whatsapp_url('Olá, quero solicitar atendimento empresarial.');
        $problemOrder = [
            'Precisa de site ou sistema?',
            'Computadores parando?',
            'Internet ou Wi-Fi instável?',
            'Sua empresa não tem backup?',
            'Usa planilhas demais?',
            'Precisa renovar computadores?',
        ];
        $problemsByTitle = collect($problemCards)->keyBy('title');
        $featuredProblems = collect($problemOrder)->map(fn(string $title) => $problemsByTitle->get($title))->filter();
        $categoriesBySlug = collect($categories)->keyBy('slug');
        $featuredCategories = collect(['sites-e-sistemas'])
            ->map(fn(string $slug) => $categoriesBySlug->get($slug))
            ->filter()
            ->merge(collect($categories)->reject(fn(array $category) => $category['slug'] === 'sites-e-sistemas'))
            ->values();
        $serviceHeroSlides = $featuredCategories
            ->map(
                fn(array $service) => [
                    'eyebrow' => 'Portal Para Empresas',
                    'title' => $service['title'],
                    'subtitle' => $service['description'],
                    'primaryButtonText' => 'Conhecer serviço',
                    'primaryButtonUrl' => route('portal.business.category', $service['slug']),
                    'secondaryButtonText' => $portal['primary_cta'],
                    'secondaryButtonUrl' => $whatsappUrl,
                    'image' => $service['hero_image'],
                    'imageAlt' => 'Solução empresarial de ' . $service['title'],
                ],
            )
            ->values()
            ->all();
        $heroSlides = array_merge(
            [
                [
                    'eyebrow' => 'Portal Para Empresas',
                    'title' => $portal['title'],
                    'subtitle' => $portal['subtitle'],
                    'primaryButtonText' => $portal['primary_cta'],
                    'primaryButtonUrl' => $whatsappUrl,
                    'secondaryButtonText' => $portal['secondary_cta'],
                    'secondaryButtonUrl' => '#solutions',
                    'image' => $portal['image'],
                    'imageAlt' => 'Soluções de tecnologia para empresas',
                ],
            ],
            $serviceHeroSlides,
        );
        $packageLevels = [
            [
                'title' => 'Essencial',
                'positioning' => 'Para começar',
                'description' =>
                    'Ideal para empresas que precisam resolver um problema específico, como computador lento, Wi-Fi instável, backup inicial ou ajustes pontuais.',
                'items' => ['Problema prioritário', 'Entrega objetiva', 'Orientações de uso'],
                'featured' => false,
            ],
            [
                'title' => 'Profissional',
                'positioning' => 'Mais escolhido',
                'description' =>
                    'Inclui a solução essencial e acrescenta mais organização, segurança e orientação para evitar que o mesmo problema volte rapidamente.',
                'items' => ['Tudo do Essencial', 'Melhorias estruturadas', 'Acompanhamento após a entrega'],
                'featured' => true,
            ],
            [
                'title' => 'Completo',
                'positioning' => 'Solução completa',
                'description' =>
                    'Indicado para empresas que desejam acompanhamento, prevenção, documentação e uma TI mais preparada para crescer com segurança.',
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
            [
                'title' => 'Atendimento claro e didático',
                'description' =>
                    'Você entende o que será feito, por que será feito e como usar melhor a solução depois da entrega.',
            ],
            [
                'title' => 'Visão integrada de suporte, redes e sistemas',
                'description' =>
                    'A SophData une suporte técnico, infraestrutura, desenvolvimento e organização digital em uma visão prática.',
            ],
            [
                'title' => 'Soluções sob medida',
                'description' =>
                    'Cada atendimento considera a realidade da empresa, o tamanho da equipe e o orçamento disponível.',
            ],
            [
                'title' => 'Foco em prevenção e organização',
                'description' =>
                    'Além de corrigir problemas, o objetivo é reduzir riscos, retrabalho e falhas recorrentes.',
            ],
            [
                'title' => 'Atendimento remoto e presencial sob consulta',
                'description' =>
                    'Muitos problemas podem ser resolvidos à distância; quando necessário, o atendimento presencial pode ser avaliado.',
            ],
            [
                'title' => 'Explicação simples, sem linguagem confusa',
                'description' => 'A tecnologia é apresentada de forma clara, sem excesso de termos técnicos.',
            ],
        ];
        $contractingOptions = [
            [
                'title' => 'Serviço pontual',
                'label' => 'Prata',
                'description' => 'Para resolver uma necessidade específica da empresa com escopo definido.',
                'items' => ['Correção de problema', 'Configuração', 'Implantação', 'Revisão', 'Melhoria específica'],
                'cta' => 'Solicitar atendimento pontual',
                'url' => sophdata_whatsapp_url('Olá, quero solicitar atendimento pontual para minha empresa.'),
                'featured' => false,
            ],
            [
                'title' => 'Contrato mensal',
                'label' => 'Dourado',
                'description' =>
                    'Para empresas que precisam de acompanhamento recorrente, prevenção e evolução contínua.',
                'items' => [
                    'Suporte contínuo',
                    'Prevenção',
                    'Backup recorrente',
                    'Manutenção',
                    'Evolução de sites, sistemas e processos',
                ],
                'cta' => 'Solicitar proposta mensal',
                'url' => sophdata_whatsapp_url('Olá, quero solicitar proposta mensal para minha empresa.'),
                'featured' => true,
            ],
        ];
    @endphp

    <x-site.hero-banner eyebrow="Portal Para Empresas" :title="$portal['title']" :subtitle="$portal['subtitle']" :primary-button-text="$portal['primary_cta']"
        :primary-button-url="$whatsappUrl" :secondary-button-text="$portal['secondary_cta']" secondary-button-url="#solutions" :image="$portal['image']"
        image-alt="Soluções de tecnologia para empresas" :slides="$heroSlides" />

    <section id="solutions" class="scroll-mt-48 bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Qual solução sua empresa precisa?" title="O que sua empresa precisa resolver?"
                description="Escolha o problema mais próximo da sua realidade e veja a solução indicada para sua empresa."
                centered />
            <div class="swiper sd_problems">
                <div class="swiper-wrapper mt-12">
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
                description="Serviços enxutos e objetivos para empresas que precisam de tecnologia funcionando sem complicação."
                centered />
            <div class="swiper sd_solutions">
                <div class="mt-12 swiper-wrapper">
                    @foreach ($featuredCategories as $category)
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
            <x-site.section-heading eyebrow="Formas de contratação" title="Como sua empresa pode contratar"
                description="Escolha entre resolver uma demanda específica ou manter acompanhamento recorrente conforme a rotina da empresa."
                centered />
            <div class="mt-12 grid items-stretch gap-6 lg:grid-cols-2">
                @foreach ($contractingOptions as $option)
                    <article @class([
                        'relative flex h-full flex-col rounded-3xl bg-white p-7 shadow-sm sm:p-8',
                        'border-2 border-gold shadow-brand-900/10' => $option['featured'],
                        'border border-slate-300' => !$option['featured'],
                    ])>
                        <span @class([
                            'inline-flex w-fit items-center rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.14em]',
                            'bg-gold text-brand-950' => $option['featured'],
                            'border border-slate-300 bg-slate-50 text-slate-700' => !$option[
                                'featured'
                            ],
                        ])>
                            {{ $option['label'] }}
                        </span>
                        <h2 class="mt-5 text-2xl font-bold text-brand-950">{{ $option['title'] }}</h2>
                        <p class="mt-4 leading-7 text-slate-600">{{ $option['description'] }}</p>
                        <ul class="mt-6 grid gap-3 text-sm font-semibold text-slate-700 sm:grid-cols-2">
                            @foreach ($option['items'] as $item)
                                <li class="flex gap-3">
                                    <span @class([
                                        'mt-0.5 grid size-5 shrink-0 place-items-center rounded-full text-xs font-bold',
                                        'bg-gold text-brand-950' => $option['featured'],
                                        'bg-slate-200 text-slate-700' => !$option['featured'],
                                    ]) aria-hidden="true">✓</span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ $option['url'] }}" target="_blank" rel="noopener noreferrer"
                            @class([
                                'mt-8 inline-flex min-h-12 w-full items-center justify-center rounded-full px-6 py-3 text-center text-sm font-bold transition sm:w-fit',
                                'bg-brand-600 text-white hover:bg-brand-700' => $option['featured'],
                                'bg-action-500 text-white hover:bg-action-600' => !$option['featured'],
                            ])>
                            {{ $option['cta'] }}
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Progressão comercial" title="Escolha o nível de atendimento ideal"
                description="Comece resolvendo o problema principal, avance para uma solução mais organizada ou escolha acompanhamento completo."
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
                        <div>
                            <h3 class="font-bold leading-7 text-brand-950">{{ $reason['title'] }}</h3>
                            <p class="mt-2 text-sm leading-6 text-slate-600">{{ $reason['description'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta-section title="Sua empresa precisa de uma TI mais organizada?"
        description="Inicie o atendimento e receba orientação para escolher a solução mais adequada para sua empresa."
        button-text="Solicitar atendimento empresarial" :button-url="$whatsappUrl" :image="config('sophdata.images.banner')"
        image-alt="Atendimento empresarial da SophData" />

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
