@extends('layouts.site')

@section('title', 'Sobre a SophData | Soluções em TI')
@section('meta_description',
    'Conheça a SophData, solução em TI para suporte, redes, sistemas, backup, segurança digital e montagem de computadores.')

@section('content')
    @php
        $whatsappUrl = sophdata_whatsapp_url('Olá, quero iniciar atendimento com a SophData.');
        $areas = [
            'Suporte técnico para pessoas e empresas',
            'Redes, Wi-Fi e infraestrutura',
            'Linux, servidores e hospedagem',
            'Desenvolvimento web com Laravel, PHP e banco de dados',
            'Sites, sistemas e automação de processos',
            'Backup, segurança digital e organização de dados',
            'Montagem, manutenção e upgrade de computadores',
        ];
        $steps = [
            [
                'title' => 'Entendemos o problema',
                'description' => 'O atendimento começa ouvindo a necessidade real do cliente, sem presumir solução antes do diagnóstico.',
            ],
            [
                'title' => 'Indicamos a solução adequada',
                'description' => 'A proposta considera urgência, orçamento, ambiente, equipamentos e objetivo do cliente.',
            ],
            [
                'title' => 'Executamos com organização',
                'description' => 'O serviço é realizado com cuidado, clareza e foco em resolver o problema sem criar nova confusão.',
            ],
            [
                'title' => 'Orientamos o cliente',
                'description' =>
                    'Depois da execução, o cliente recebe explicação simples sobre o que foi feito e como usar melhor a solução.',
            ],
            [
                'title' => 'Acompanhamos quando contratado',
                'description' =>
                    'Para empresas e demandas recorrentes, a SophData pode acompanhar a rotina e prevenir novos problemas.',
            ],
        ];
        $values = [
            ['title' => 'Clareza', 'description' => 'Explicar tecnologia de forma compreensível, sem linguagem desnecessariamente complicada.'],
            ['title' => 'Confiança', 'description' => 'Tratar arquivos, equipamentos, contas e informações com responsabilidade.'],
            ['title' => 'Organização', 'description' => 'Resolver problemas deixando o ambiente mais simples de manter.'],
            ['title' => 'Solução prática', 'description' => 'Priorizar o que realmente ajuda o cliente a trabalhar, estudar ou se organizar melhor.'],
            ['title' => 'Acompanhamento', 'description' => 'Oferecer continuidade quando o cliente precisa de suporte recorrente.'],
        ];
    @endphp

    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-8xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-[1fr_.9fr] lg:px-8">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-600">Sobre</p>
                <h1 class="mt-4 text-4xl font-bold tracking-tight text-brand-950 sm:text-5xl">Sobre a SophData</h1>
                <p class="mt-6 max-w-2xl text-lg leading-8 text-slate-600">
                    Tecnologia com clareza, organização e confiança para pessoas, pequenos negócios e instituições.
                </p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                    class="mt-8 inline-flex min-h-12 items-center justify-center rounded-full bg-action-500 px-6 py-3 text-sm font-bold text-white hover:bg-action-600">
                    Iniciar atendimento
                </a>
            </div>
            <figure class="rounded-[2rem] border border-brand-100 bg-white p-8 shadow-xl">
                <x-site.logo class="mb-8" />
                <img src="{{ asset(config('sophdata.images.about')) }}" alt="Imagem institucional da SophData"
                    class="aspect-square w-full rounded-3xl object-cover" loading="lazy" decoding="async">
            </figure>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-8xl gap-12 px-4 sm:px-6 lg:grid-cols-[.9fr_1.1fr] lg:px-8">
            <div>
                <x-site.section-heading eyebrow="Quem somos" title="Tecnologia explicada de forma simples e aplicada à rotina real"
                    description="A SophData oferece soluções em TI para pessoas, pequenos negócios e instituições que precisam de tecnologia funcionando com clareza, segurança e organização. O atendimento é prático, explicado em linguagem simples e pensado para resolver problemas reais: computadores lentos, redes instáveis, falta de backup, sites, sistemas e processos manuais." />
            </div>
            <article class="rounded-[2rem] bg-brand-950 p-8 text-white shadow-xl sm:p-10">
                <h2 class="text-sm font-bold uppercase tracking-[0.18em] text-brand-300">Nossa proposta</h2>
                <p class="mt-5 text-3xl font-bold leading-tight">Unir conhecimento técnico, explicação simples e atendimento responsável.
                </p>
                <p class="mt-5 leading-8 text-brand-100/80">{{ config('sophdata.brand.slogan') }}</p>
            </article>
        </div>
    </section>

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Experiência aplicada" title="Experiência aplicada à rotina real"
                description="A SophData reúne experiência em suporte técnico, redes, Linux, desenvolvimento web, banco de dados, manutenção de sistemas, montagem de computadores e atendimento a pequenos negócios e instituições. A proposta é unir conhecimento técnico com explicação simples e atendimento responsável."
                centered />
            <div class="mt-12 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($areas as $area)
                    <article class="rounded-2xl border border-slate-200 bg-white p-6 font-bold text-brand-950 shadow-sm">
                        {{ $area }}</article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Experiência técnica" title="Tecnologias e áreas conectadas ao atendimento"
                description="Suporte, redes, sistemas, Linux, desenvolvimento, backup, segurança e computadores aplicados a necessidades reais." centered />
            <div class="mt-10 flex flex-wrap justify-center gap-3">
                @foreach (config('sophdata.technologies') as $technology)
                    <span
                        class="rounded-full border border-brand-200 bg-brand-50 px-5 py-3 text-sm font-bold text-brand-800">{{ $technology }}</span>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Forma de trabalho" title="Como a SophData trabalha" centered />
            <x-site.process-steps :steps="$steps" class="mt-12 md:grid-cols-2 lg:grid-cols-5" />
        </div>
    </section>

    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Valores" title="Valores que orientam o atendimento" centered />
            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($values as $value)
                    <article class="rounded-3xl border border-brand-100 bg-white p-7 shadow-sm">
                        <h3 class="text-xl font-bold text-brand-950">{{ $value['title'] }}</h3>
                        <p class="mt-3 leading-7 text-slate-600">{{ $value['description'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta-section title="Precisa de uma tecnologia mais organizada?"
        description="Inicie o atendimento e receba orientação para encontrar a solução mais adequada."
        button-text="Iniciar atendimento" :button-url="$whatsappUrl" />
@endsection
