@extends('layouts.site')

@section('title', 'SophData | Soluções de TI para Empresas')
@section('meta_description',
    'Suporte de TI, redes, segurança, backup, sites, sistemas, automação e computadores
    corporativos para pequenos negócios e instituições.')

@section('content')
    @php
        $empresa = config('sophdata_empresa');
        $hero = $empresa['hero'];
        $mainBlocks = collect($empresa['main_blocks'] ?? []);
        $businessPains = $empresa['business_pains'] ?? [];
        $methodSteps = $empresa['method_summary'] ?? [];
        $authority = $empresa['authority'] ?? [];
        $cta = $empresa['cta'];
        $heroPrimaryUrl = filled($hero['primary_cta']['whatsapp_message'] ?? null)
            ? (sophdata_whatsapp_url($hero['primary_cta']['whatsapp_message']) ?: $hero['primary_cta']['url'])
            : $hero['primary_cta']['url'];
        $finalCtaUrl = filled($cta['whatsapp_message'] ?? null)
            ? (sophdata_whatsapp_url($cta['whatsapp_message']) ?: $cta['primary_url'])
            : $cta['primary_url'];

        $blockDescriptions = [
            'desenvolvimento-de-software' => 'Sites, sistemas e automações para organizar processos, substituir planilhas e melhorar a presença digital da empresa.',
            'infraestrutura-corporativa-gerenciada' => 'Computadores, redes, Wi-Fi e suporte mensal organizados para dar mais estabilidade à operação.',
            'servidores-e-ambientes-corporativos' => 'Ambientes para centralizar arquivos, controlar acessos, proteger dados e apoiar a continuidade da empresa.',
        ];

        $blockCtas = [
            'desenvolvimento-de-software' => 'Ver soluções de software',
            'infraestrutura-corporativa-gerenciada' => 'Ver infraestrutura gerenciada',
            'servidores-e-ambientes-corporativos' => 'Ver servidores e ambientes',
        ];

        $contractingOptions = [
            [
                'title' => 'Diagnóstico',
                'description' => 'Para entender o cenário e recomendar o melhor caminho.',
            ],
            [
                'title' => 'Projeto fechado',
                'description' => 'Para entregas com escopo definido, prazo e critérios de aceite.',
            ],
            [
                'title' => 'Implantação',
                'description' => 'Para organizar servidores, redes, computadores, backup ou ambientes.',
            ],
            [
                'title' => 'Administração mensal',
                'description' => 'Para manter suporte, acompanhamento, documentação e melhorias contínuas.',
            ],
            [
                'title' => 'Evolução',
                'description' => 'Para sistemas, sites e ambientes que precisam crescer com a operação.',
            ],
        ];

        $recommendedPaths = [
            [
                'title' => 'Presença Digital',
                'description' => 'Para empresas que precisam de site, página comercial, landing page ou portal.',
                'image' => 'img/sophdata/services/business/sites-e-sistemas.webp',
                'image_alt' => 'Presença digital com site e portal empresarial',
                'url' => '/para-empresas/desenvolvimento-de-software/sites-e-portais',
            ],
            [
                'title' => 'Sistema Administrativo',
                'description' => 'Para empresas que desejam sair das planilhas e organizar processos internos.',
                'image' => 'img/sophdata/services/business/sites-e-sistemas-hero.webp',
                'image_alt' => 'Sistema administrativo para organizar processos internos',
                'url' => '/para-empresas/desenvolvimento-de-software/sistemas-sob-medida',
            ],
            [
                'title' => 'Suporte, Rede e Infraestrutura',
                'description' => 'Para empresas que precisam organizar computadores, rede, Wi-Fi e suporte mensal.',
                'image' => 'img/sophdata/services/business/suporte-de-ti-hero.webp',
                'image_alt' => 'Infraestrutura gerenciada com suporte e rede corporativa',
                'url' => '/para-empresas/infraestrutura-corporativa-gerenciada',
            ],
            [
                'title' => 'Arquivos e Backup',
                'description' => 'Para empresas que precisam centralizar documentos, controlar acessos e proteger dados.',
                'image' => 'img/sophdata/services/business/seguranca-e-backup.webp',
                'image_alt' => 'Arquivos e backup empresarial para proteger dados',
                'url' => '/para-empresas/servidores-e-ambientes-corporativos',
            ],
            [
                'title' => 'Diagnóstico Empresarial',
                'description' => 'Para empresas que ainda não sabem qual solução contratar primeiro.',
                'image' => $cta['image'],
                'image_alt' => $cta['image_alt'] ?? 'Atendimento empresarial da SophData',
                'url' => '/para-empresas/contato',
            ],
        ];
    @endphp

    <x-site.hero-banner eyebrow="Portal Para Empresas" :title="$hero['title']" :subtitle="$hero['subtitle']"
        primary-button-text="Solicitar diagnóstico empresarial" :primary-button-url="$heroPrimaryUrl"
        :secondary-button-text="$hero['secondary_cta']['label']" :secondary-button-url="$hero['secondary_cta']['url']"
        :image="$hero['image']" image-alt="Soluções de tecnologia para empresas" />

    <section id="dores-empresariais" class="scroll-mt-48 bg-white py-16 sm:py-20 lg:py-24" aria-labelledby="dores-empresariais-title">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Dores empresariais" title="Sua empresa sente algum desses problemas?"
                description="A tecnologia deve sustentar a operação, não ser mais uma fonte de improviso." centered title-id="dores-empresariais-title" />

            <ul class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($businessPains as $pain)
                    <li class="flex gap-4 rounded-3xl border border-slate-200 bg-slate-50 p-6">
                        <span class="grid size-10 shrink-0 place-items-center rounded-full bg-brand-100 font-bold text-brand-700"
                            aria-hidden="true">✓</span>
                        <p class="font-semibold leading-7 text-brand-950">{{ $pain }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <section id="solucoes" class="scroll-mt-48 bg-brand-50 py-16 sm:py-20 lg:py-24" aria-labelledby="solucoes-title">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Catálogo empresarial"
                title="Soluções empresariais organizadas por necessidade"
                description="Escolha a frente que melhor representa o momento da sua empresa." centered title-id="solucoes-title" />

            <ul class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($mainBlocks as $block)
                    <li>
                        <x-site.category-card :title="$block['title']" :description="$blockDescriptions[$block['slug']] ?? $block['description']" :image="$block['image']"
                            :url="$block['route']" :items="array_slice($block['pains'] ?? [], 0, 3)" :image-alt="$block['image_alt'] ?? null" :cta-label="$blockCtas[$block['slug']] ?? $block['cta']['label']" />
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-site.authority-section class="bg-white" :authority="$authority" />

    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Formas de contratação"
                title="Contratação conforme a necessidade da empresa"
                description="Nem todo cliente precisa começar por um projeto grande. A SophData organiza a solução em etapas, conforme o cenário e a prioridade."
                centered />

            <x-site.process-steps :steps="$contractingOptions" class="mt-12 lg:grid-cols-5" />
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Método de atendimento" title="Como trabalhamos"
                description="Tecnologia empresarial precisa de método. Primeiro entendemos, depois planejamos, implantamos e acompanhamos."
                centered />

            <x-site.process-steps :steps="$methodSteps" class="mt-12 lg:grid-cols-5" />
        </div>
    </section>

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Caminhos recomendados" title="Caminhos recomendados para começar"
                description="A escolha depende do momento da empresa: presença digital, organização interna, infraestrutura ou ambiente corporativo."
                centered />

            <ul class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-5">
                @foreach ($recommendedPaths as $path)
                    <li>
                        <x-site.category-card :title="$path['title']" :description="$path['description']" :image="$path['image']" :url="$path['url']"
                            :image-alt="$path['image_alt'] ?? null" cta-label="Ver caminho" />
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

    <x-site.cta-section :title="$cta['title']" :description="$cta['description']" button-text="Solicitar diagnóstico empresarial"
        :button-url="$finalCtaUrl" :image="$cta['image']" :image-alt="$cta['image_alt'] ?? 'Atendimento empresarial da SophData'" />
@endsection
