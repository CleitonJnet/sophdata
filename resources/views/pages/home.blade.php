@extends('layouts.site')

@section('title', 'SophData | Soluções em TI para pessoas e empresas')
@section('meta_description', 'Suporte técnico, segurança digital, sites, sistemas, redes, backup, automação e montagem de computadores para pessoas e pequenos negócios.')

@section('content')
    @php
        $whatsappNumber = config('sophdata.brand.whatsapp');
        $whatsappUrl = sophdata_whatsapp_url('Olá, gostaria de conhecer as soluções da SophData.');

        $solutions = [
            [
                'title' => 'Suporte Técnico',
                'description' => 'Diagnóstico e solução de problemas em computadores, dispositivos e contas digitais.',
                'image' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Suporte+Tecnico',
                'url' => route('para-voce').'#suporte-digital-pessoal',
            ],
            [
                'title' => 'Segurança e Backup',
                'description' => 'Proteção de dados, acessos e arquivos importantes para pessoas e empresas.',
                'image' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Seguranca+e+Backup',
                'url' => route('para-empresas').'#seguranca-e-backup',
            ],
            [
                'title' => 'Sites e Sistemas',
                'description' => 'Presença digital e aplicações web alinhadas aos processos e objetivos do negócio.',
                'image' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Sites+e+Sistemas',
                'url' => route('para-empresas').'#sites-e-presenca-digital',
            ],
            [
                'title' => 'Redes e Infraestrutura',
                'description' => 'Wi-Fi, conectividade e equipamentos organizados para trabalhar com estabilidade.',
                'image' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Redes+e+Infraestrutura',
                'url' => route('para-empresas').'#infraestrutura-e-redes',
            ],
            [
                'title' => 'Montagem de Computadores',
                'description' => 'Computadores planejados, montados e atualizados conforme uso e orçamento.',
                'image' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Montagem+de+Computadores',
                'url' => route('para-voce').'#montagem-e-upgrade-de-computadores',
            ],
            [
                'title' => 'Consultoria e Automação',
                'description' => 'Orientação, organização de processos e automações para ganhar produtividade.',
                'image' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Consultoria+e+Automacao',
                'url' => route('para-empresas').'#consultoria-e-treinamentos',
            ],
        ];

        $packages = [
            [
                'level' => 'Essencial',
                'name' => 'Atendimento Essencial',
                'subtitle' => 'Resolve a necessidade principal',
                'description' => 'Atendimento direto para diagnosticar e resolver uma demanda específica.',
                'included_items' => ['Diagnóstico inicial', 'Execução do serviço combinado', 'Orientação básica após a entrega'],
                'featured' => false,
                'badge' => 'Para começar',
                'button_text' => 'Falar no WhatsApp',
                'whatsapp_message' => 'Olá, gostaria de saber mais sobre o pacote Atendimento Essencial.',
            ],
            [
                'level' => 'Profissional',
                'name' => 'Solução Profissional',
                'subtitle' => 'Organização, segurança e melhor custo-benefício',
                'description' => 'Uma solução mais completa para corrigir, organizar e reduzir novos problemas.',
                'included_items' => ['Tudo do atendimento essencial', 'Organização e otimização', 'Cuidados adicionais de segurança'],
                'featured' => true,
                'badge' => 'Mais escolhido',
                'button_text' => 'Falar no WhatsApp',
                'whatsapp_message' => 'Olá, gostaria de saber mais sobre o pacote Solução Profissional.',
            ],
            [
                'level' => 'Completo',
                'name' => 'Acompanhamento Completo',
                'subtitle' => 'Prevenção e visão de continuidade',
                'description' => 'Atendimento abrangente com acompanhamento para manter a tecnologia organizada.',
                'included_items' => ['Tudo da solução profissional', 'Plano de prevenção e continuidade', 'Acompanhamento após a entrega'],
                'featured' => false,
                'badge' => 'Cobertura completa',
                'button_text' => 'Falar no WhatsApp',
                'whatsapp_message' => 'Olá, gostaria de saber mais sobre o pacote Acompanhamento Completo.',
            ],
        ];

        $differentials = [
            config('sophdata.differentials.0'),
            config('sophdata.differentials.1'),
            config('sophdata.differentials.2'),
            config('sophdata.differentials.3'),
            config('sophdata.differentials.6'),
        ];

        $steps = [
            ['title' => 'Envie sua necessidade', 'description' => 'Você explica pelo WhatsApp o que precisa resolver ou melhorar.'],
            ['title' => 'Diagnóstico inicial', 'description' => 'Eu avalio o cenário, faço perguntas e identifico prioridades.'],
            ['title' => 'Escolha da solução', 'description' => 'Você recebe a indicação do serviço ou pacote mais adequado.'],
            ['title' => 'Execução combinada', 'description' => 'O trabalho é realizado conforme escopo, prazo e formato acordados.'],
            ['title' => 'Orientação final', 'description' => 'Você recebe instruções para continuar usando tudo com segurança.'],
        ];

        $faq = array_slice(config('sophdata.faq'), 0, 5);
    @endphp

    <x-site.hero-banner
        eyebrow="SophData"
        title="Soluções em TI para pessoas, pequenos negócios e instituições"
        subtitle="Suporte técnico, montagem de computadores, segurança digital, sites, sistemas, redes, backup e automação para quem precisa de tecnologia funcionando com clareza e confiança."
        primary-button-text="Quero atendimento para mim"
        :primary-button-url="route('para-voce')"
        secondary-button-text="Quero soluções para minha empresa"
        :secondary-button-url="route('para-empresas')"
        tertiary-button-text="Falar no WhatsApp"
        :tertiary-button-url="$whatsappUrl"
        image="https://placehold.co/720x520/0B1F4D/FFFFFF?text=Solucoes+em+TI"
    />

    <x-site.quick-action-bar class="-mt-7" />

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading
                eyebrow="Escolha seu perfil"
                title="Soluções organizadas para cada realidade"
                description="Encontre rapidamente serviços para sua vida digital ou para a operação da sua empresa."
                centered
            />
            <x-site.profile-switch class="mt-12" />
        </div>
    </section>

    <section id="principais-solucoes" class="scroll-mt-48 bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading
                eyebrow="Principais soluções"
                title="Tecnologia prática para problemas reais"
                description="Serviços que ajudam a recuperar produtividade, proteger informações e preparar os próximos passos."
                centered
            />
            <div class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($solutions as $solution)
                    <x-site.offer-card
                        :title="$solution['title']"
                        :description="$solution['description']"
                        :image="$solution['image']"
                        :url="$solution['url']"
                        button-text="Conhecer solução"
                    />
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading
                eyebrow="Pacotes em destaque"
                title="Escolha o nível de atendimento"
                description="Comece pelo essencial ou escolha uma cobertura maior para organizar, prevenir e acompanhar."
                centered
            />
            <div class="mt-12 grid gap-6 lg:grid-cols-3">
                @foreach ($packages as $package)
                    <x-site.package-card :package="$package" :whatsapp-number="$whatsappNumber" />
                @endforeach
            </div>
        </div>
    </section>

    <x-site.cta-section
        title="Tecnologia bem organizada evita perda de tempo, retrabalho e prejuízos."
        description="Da manutenção do computador ao desenvolvimento de sistemas, a SophData ajuda você a transformar problemas técnicos em soluções práticas."
        image="https://placehold.co/1200x360/0B1F4D/FFFFFF?text=Tecnologia+Organizada"
        class="bg-white"
    />

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading
                eyebrow="Diferenciais SophData"
                title="Atendimento técnico que você consegue entender"
                description="Experiência prática, orientação clara e soluções proporcionais à sua necessidade."
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

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading
                eyebrow="Como funciona o atendimento"
                title="Cinco etapas simples e transparentes"
                description="Você acompanha o caminho desde a primeira conversa até a orientação final."
                centered
            />
            <x-site.process-steps :steps="$steps" class="mt-12 lg:grid-cols-5" />
        </div>
    </section>

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <x-site.section-heading
                eyebrow="Perguntas frequentes"
                title="Respostas rápidas antes do atendimento"
                description="Confira as dúvidas mais comuns sobre serviços, formatos e contratação."
                centered
            />
            <x-site.faq :items="$faq" class="mt-12" />
        </div>
    </section>

    <x-site.cta-section
        title="Precisa organizar sua tecnologia?"
        description="Fale agora pelo WhatsApp e explique sua necessidade. A SophData ajuda você a encontrar o pacote mais adequado."
        button-text="Falar no WhatsApp"
        :button-url="$whatsappUrl"
        image="https://placehold.co/1200x360/F3F6FA/0B1F4D?text=Atendimento+SophData"
    />
@endsection
