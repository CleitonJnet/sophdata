@extends('layouts.site')

@section('title', 'Sobre | SophData')
@section('meta_description', 'Conheça a SophData, uma marca de soluções em TI com foco em clareza, organização, confiança e atendimento prático.')

@section('content')
    @php
        $whatsappUrl = sophdata_whatsapp_url('Olá, gostaria de conhecer as soluções da SophData.');
        $areas = [
            'Suporte técnico',
            'Redes',
            'Linux',
            'Sistemas web',
            'Laravel',
            'PHP',
            'MySQL',
            'PostgreSQL',
            'Java',
            'Spring Boot',
            'Backup',
            'Segurança digital',
            'Montagem e upgrade de computadores',
        ];
        $steps = [
            ['title' => 'Diagnóstico inicial', 'description' => 'Entendemos a necessidade, o contexto e o resultado esperado.'],
            ['title' => 'Proposta adequada', 'description' => 'Apresentamos um escopo proporcional, claro e alinhado ao momento do cliente.'],
            ['title' => 'Execução organizada', 'description' => 'Realizamos o trabalho conforme prioridades, prazos e condições combinadas.'],
            ['title' => 'Orientação ao cliente', 'description' => 'Explicamos o que foi feito e como usar a solução com mais segurança.'],
            ['title' => 'Acompanhamento', 'description' => 'Quando contratado, acompanhamos o ambiente para prevenir e evoluir.'],
        ];
        $values = [
            ['title' => 'Clareza', 'description' => 'Comunicação direta e compreensível em todas as etapas.'],
            ['title' => 'Confiança', 'description' => 'Relações responsáveis, transparentes e duradouras.'],
            ['title' => 'Organização', 'description' => 'Processos, informações e entregas tratados com método.'],
            ['title' => 'Responsabilidade', 'description' => 'Cuidado técnico com dados, equipamentos e decisões.'],
            ['title' => 'Solução prática', 'description' => 'Tecnologia aplicada a problemas e objetivos reais.'],
            ['title' => 'Acompanhamento', 'description' => 'Suporte para a solução continuar útil depois da entrega.'],
        ];
    @endphp

    <x-site.hero-banner
        eyebrow="Institucional"
        title="Sobre a SophData"
        subtitle="Tecnologia com clareza, organização e confiança para pessoas, pequenos negócios e instituições."
        primary-button-text="Fale com a SophData"
        :primary-button-url="$whatsappUrl"
        secondary-button-text="Conheça nossa atuação"
        secondary-button-url="#quem-somos"
        image="https://placehold.co/720x520/F3F6FA/0B1F4D?text=Sobre+SophData"
        variant="light"
    />

    <section id="quem-somos" class="scroll-mt-48 bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-4 sm:px-6 lg:grid-cols-[1fr_.9fr] lg:px-8">
            <div>
                <x-site.section-heading
                    eyebrow="Quem somos"
                    title="Tecnologia próxima, organizada e útil"
                    description="A SophData nasceu para ajudar pessoas, pequenos negócios e instituições a usarem melhor a tecnologia, com atendimento claro, organizado e confiável."
                />
                <p class="mt-6 leading-8 text-slate-600">
                    Unimos experiência técnica e comunicação simples para transformar dificuldades, riscos e ideias em soluções que façam sentido para cada realidade.
                </p>
            </div>
            <div class="rounded-[2rem] bg-brand-950 p-8 text-white shadow-xl sm:p-10">
                <h3 class="text-sm font-bold uppercase tracking-[0.18em] text-brand-300">Nossa proposta</h3>
                <p class="mt-5 text-3xl font-bold leading-tight">Entender antes de recomendar. Organizar antes de executar.</p>
                <p class="mt-5 leading-8 text-brand-100/75">{{ config('sophdata.brand.slogan') }}</p>
            </div>
        </div>
    </section>

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading
                eyebrow="Áreas de atuação"
                title="Experiência que conecta suporte, infraestrutura e desenvolvimento"
                description="Atuação em tecnologias e serviços que ajudam a manter ambientes digitais funcionando e evoluindo."
                centered
            />
            <div class="mt-12 grid gap-4 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($areas as $area)
                    <article class="flex min-h-24 items-center gap-4 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <span class="grid size-10 shrink-0 place-items-center rounded-xl bg-brand-100 text-sm font-bold text-brand-700">
                            {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <h3 class="font-bold text-brand-950">{{ $area }}</h3>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading
                eyebrow="Forma de trabalho"
                title="Um processo claro do diagnóstico ao acompanhamento"
                description="Cada etapa ajuda a manter expectativas, prioridades e responsabilidades bem definidas."
                centered
            />
            <x-site.process-steps :steps="$steps" class="mt-12 md:grid-cols-2 lg:grid-cols-5" />
        </div>
    </section>

    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading
                eyebrow="Valores"
                title="Princípios que orientam cada atendimento"
                centered
            />
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

    <x-site.cta-section
        title="Fale com a SophData"
        description="Converse sobre sua necessidade e descubra como organizar sua tecnologia com mais clareza e confiança."
        button-text="Iniciar conversa"
        :button-url="$whatsappUrl"
    />
@endsection
