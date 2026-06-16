@props(['category', 'portal', 'faq'])

@php
    $isBusiness = $portal['key'] === 'business';
    $primaryCta = $isBusiness ? 'Solicitar atendimento empresarial' : 'Quero atendimento';
    $whatsappUrl = sophdata_whatsapp_url(
        $isBusiness
            ? "Olá, quero atendimento empresarial para {$category['title']}."
            : "Olá, quero atendimento para {$category['title']}.",
    );
    $contractingModes = $isBusiness ? ($category['contracting_modes'] ?? []) : [];
    $serviceFormats = ! $isBusiness ? ($category['service_formats'] ?? []) : [];
    $steps = [
        [
            'title' => 'Primeiro contato',
            'description' => 'Você explica o problema, o contexto e o resultado que espera.',
        ],
        [
            'title' => 'Diagnóstico',
            'description' => 'A necessidade é analisada para definir prioridades e o nível de atendimento.',
        ],
        ['title' => 'Proposta', 'description' => 'Você recebe uma recomendação clara de pacote, escopo e condições.'],
        ['title' => 'Execução', 'description' => 'A solução é aplicada conforme o escopo e as prioridades combinadas.'],
        [
            'title' => 'Orientação final',
            'description' => 'Você entende o que foi feito e recebe orientações para usar ou manter a solução.',
        ],
    ];
    $choices = [
        [
            'title' => 'Escolha o Essencial',
            'description' => $category['choice_descriptions']['essential'] ?? 'Se você precisa resolver algo pontual com uma entrega direta e objetiva.',
        ],
        [
            'title' => 'Escolha o Profissional',
            'description' => $category['choice_descriptions']['professional'] ??
                'Se você quer resolver a necessidade e organizar melhor o ambiente, com melhorias e acompanhamento.',
        ],
        [
            'title' => 'Escolha o Completo',
            'description' => $category['choice_descriptions']['complete'] ?? 'Se você busca prevenção, acompanhamento, documentação e continuidade.',
        ],
    ];
@endphp

<nav aria-label="Breadcrumb" class="border-b border-slate-200 bg-white">
    <ol class="mx-auto flex min-h-12 max-w-8xl items-center gap-2 px-4 py-3 text-sm sm:px-6 lg:px-8">
        <li>
            <a href="{{ route($portal['route']) }}"
                class="rounded-md font-semibold text-brand-700 underline underline-offset-4 transition hover:text-brand-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2">
                {{ $portal['label'] }}
            </a>
        </li>
        <li aria-hidden="true" class="select-none text-slate-400">/</li>
        <li aria-current="page" class="font-semibold text-slate-600">
            {{ $category['title'] }}
        </li>
    </ol>
</nav>

<x-site.hero-banner :eyebrow="$portal['label']" :title="$category['title']" :subtitle="$category['description']" :primary-button-text="$primaryCta" :primary-button-url="$whatsappUrl"
    secondary-button-text="Ver pacotes" secondary-button-url="#packages" :image="$category['hero_image']" :image-alt="'Solução de ' . $category['title']"
    :variant="$isBusiness ? 'dark' : 'light'" />

<section class="bg-white py-16 sm:py-20 lg:py-24">
    <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
        <x-site.section-heading eyebrow="Problemas atendidos" title="O que essa solução resolve?"
            description="Situações reais que podem ser organizadas com orientação e um escopo adequado." centered />
        <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($category['problems_solved'] as $problem)
                @php
                    $problemTitle = is_array($problem) ? $problem['title'] : $problem;
                    $problemDescription = is_array($problem)
                        ? $problem['description']
                        : 'A SophData ajuda a entender a causa, organizar a solução e orientar os próximos passos sem linguagem complicada.';
                @endphp
                <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                    <span class="grid size-10 place-items-center rounded-full bg-brand-100 font-bold text-brand-700"
                        aria-hidden="true">✓</span>
                    <h3 class="mt-5 text-lg font-bold leading-7 text-brand-950">{{ $problemTitle }}</h3>
                    <p class="mt-3 text-sm leading-6 text-slate-600">
                        {{ $problemDescription }}
                    </p>
                </article>
            @endforeach
        </div>
    </div>
</section>

@if ($isBusiness && filled($contractingModes))
    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Formas de contratação" title="Escolha a forma de contratação"
                description="Contrate este serviço como uma demanda pontual ou avalie acompanhamento recorrente quando fizer sentido para a rotina da empresa."
                centered />
            <div class="mt-12 grid items-stretch gap-6 lg:grid-cols-2">
                @foreach ($contractingModes as $modeKey => $mode)
                    @php
                        $isMonthlyContract = $modeKey === 'monthly_contract';
                        $isRecommended = (bool) ($mode['recommended'] ?? false);
                        $modeUrl = sophdata_whatsapp_url(
                            $mode['whatsapp_message'] ??
                                "Olá, quero atendimento empresarial para {$category['title']}.",
                        );
                    @endphp
                    <article @class([
                        'relative flex h-full flex-col rounded-3xl bg-white p-7 shadow-sm sm:p-8',
                        'border-2 border-gold shadow-brand-900/10' => $isRecommended,
                        'border border-gold/70' => $isMonthlyContract && !$isRecommended,
                        'border border-slate-300' => !$isMonthlyContract,
                    ])>
                        <div class="flex flex-wrap items-center gap-3">
                            <span @class([
                                'grid size-10 place-items-center rounded-full font-bold',
                                'bg-gold text-brand-950' => $isMonthlyContract,
                                'bg-slate-200 text-slate-700' => !$isMonthlyContract,
                            ]) aria-hidden="true">
                                {{ $isMonthlyContract ? 'M' : 'P' }}
                            </span>
                            @if (filled($mode['recommendation_label'] ?? null))
                                <span @class([
                                    'rounded-full px-3 py-1 text-xs font-bold uppercase tracking-[0.14em]',
                                    'bg-gold text-brand-950' => $isRecommended,
                                    'border border-gold/60 bg-gold/10 text-brand-900' => $isMonthlyContract && !$isRecommended,
                                    'border border-slate-300 bg-slate-50 text-slate-700' => !$isMonthlyContract,
                                ])>
                                    {{ $mode['recommendation_label'] }}
                                </span>
                            @endif
                        </div>
                        <h2 class="mt-5 text-2xl font-bold text-brand-950">{{ $mode['title'] }}</h2>
                        <p class="mt-4 leading-7 text-slate-600">{{ $mode['description'] }}</p>
                        <ul class="mt-6 grid gap-3 text-sm font-semibold text-slate-700">
                            @foreach ($mode['items'] as $item)
                                <li class="flex gap-3">
                                    <span @class([
                                        'mt-0.5 grid size-5 shrink-0 place-items-center rounded-full text-xs font-bold',
                                        'bg-gold text-brand-950' => $isMonthlyContract,
                                        'bg-slate-200 text-slate-700' => !$isMonthlyContract,
                                    ]) aria-hidden="true">✓</span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ $modeUrl }}" target="_blank" rel="noopener noreferrer" @class([
                            'mt-8 inline-flex min-h-12 w-full items-center justify-center rounded-full px-6 py-3 text-center text-sm font-bold transition sm:w-fit',
                            'bg-brand-600 text-white hover:bg-brand-700' => $isMonthlyContract,
                            'bg-action-500 text-white hover:bg-action-600' => !$isMonthlyContract,
                        ])>
                            {{ $mode['cta_label'] }}
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

@if (! $isBusiness && filled($serviceFormats))
    <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading eyebrow="Formato de atendimento" title="Formato de atendimento"
                description="Escolha entre resolver uma necessidade pontual, fazer uma revisão mais ampla ou receber orientação complementar."
                centered />
            <div class="mt-12 grid items-stretch gap-6 lg:grid-cols-3">
                @foreach ($serviceFormats as $formatKey => $format)
                    @php
                        $isCompleteReview = $formatKey === 'complete_review';
                        $formatUrl = sophdata_whatsapp_url(
                            $format['whatsapp_message'] ??
                                "Olá, quero atendimento para {$category['title']}.",
                        );
                    @endphp
                    <article @class([
                        'relative flex h-full flex-col rounded-3xl bg-white p-7 shadow-sm sm:p-8',
                        'border-2 border-brand-500 shadow-brand-900/10 after:absolute after:inset-x-8 after:top-0 after:h-1 after:rounded-b-full after:bg-gold' => $isCompleteReview,
                        'border border-slate-300' => !$isCompleteReview,
                    ])>
                        <span @class([
                            'grid size-10 place-items-center rounded-full font-bold',
                            'bg-brand-600 text-white' => $isCompleteReview,
                            'bg-slate-200 text-slate-700' => !$isCompleteReview,
                        ]) aria-hidden="true">
                            {{ $loop->iteration }}
                        </span>
                        <h2 class="mt-5 text-2xl font-bold text-brand-950">{{ $format['title'] }}</h2>
                        <p class="mt-4 leading-7 text-slate-600">{{ $format['description'] }}</p>
                        <ul class="mt-6 grid gap-3 text-sm font-semibold text-slate-700">
                            @foreach ($format['items'] as $item)
                                <li class="flex gap-3">
                                    <span @class([
                                        'mt-0.5 grid size-5 shrink-0 place-items-center rounded-full text-xs font-bold',
                                        'bg-brand-600 text-white' => $isCompleteReview,
                                        'bg-slate-200 text-slate-700' => !$isCompleteReview,
                                    ]) aria-hidden="true">✓</span>
                                    {{ $item }}
                                </li>
                            @endforeach
                        </ul>
                        <a href="{{ $formatUrl }}" target="_blank" rel="noopener noreferrer" @class([
                            'mt-8 inline-flex min-h-12 w-full items-center justify-center rounded-full px-6 py-3 text-center text-sm font-bold transition',
                            'bg-brand-600 text-white hover:bg-brand-700' => $isCompleteReview,
                            'bg-action-500 text-white hover:bg-action-600' => !$isCompleteReview,
                        ])>
                            {{ $format['cta_label'] }}
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

<section id="packages" class="scroll-mt-48 bg-slate-50 py-16 sm:py-20 lg:py-24">
    <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
        <x-site.section-heading eyebrow="Pacotes de atendimento" title="Escolha o pacote ideal"
            description="Comece pelo essencial, avance para o recomendado ou escolha a solução completa." centered />
        <div class="mt-12 grid items-stretch gap-6 lg:grid-cols-3">
            @foreach ($category['packages'] as $package)
                <x-site.package-card :package="$package" />
            @endforeach
        </div>
    </div>
</section>

<section class="bg-white py-16 sm:py-20 lg:py-24">
    <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
        <x-site.section-heading eyebrow="Visão lado a lado" title="Compare os pacotes"
            description="Veja rapidamente como os níveis evoluem em organização, segurança e acompanhamento."
            centered />
        <x-site.package-comparison :packages="$category['packages']" class="mt-12" />
    </div>
</section>

<section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
    <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
        <x-site.section-heading eyebrow="Decisão simples" title="Como escolher?"
            description="Use o resultado que você espera como ponto de partida." centered />
        <div class="mt-12 grid gap-6 lg:grid-cols-3">
            @foreach ($choices as $choice)
                <article class="rounded-3xl border border-brand-100 bg-white p-7 shadow-sm">
                    <h3 class="text-xl font-bold text-brand-950">{{ $choice['title'] }}</h3>
                    <p class="mt-4 leading-7 text-slate-600">{{ $choice['description'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-white py-16 sm:py-20 lg:py-24">
    <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
        <x-site.section-heading eyebrow="Etapas" title="Como funciona o atendimento"
            description="Um processo claro para entender, propor, executar e orientar." centered />
        <x-site.process-steps :steps="$steps" class="mt-12 md:grid-cols-2 lg:grid-cols-5" />
    </div>
</section>

<section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
    <div class="mx-auto max-w-4xl px-4 sm:px-6">
        <x-site.section-heading eyebrow="Dúvidas frequentes" title="Perguntas sobre esta solução"
            description="Respostas para ajudar você a avançar com mais segurança." centered />
        <x-site.faq :items="$faq" class="mt-12" />
    </div>
</section>

<x-site.cta-section :title="$isBusiness ? 'Pronto para organizar esta área da sua empresa?' : 'Quer resolver isso com orientação clara?'" :description="$isBusiness
    ? 'Inicie o atendimento e receba orientação para escolher o melhor pacote.'
    : 'Inicie o atendimento e receba ajuda para escolher o pacote mais adequado.'" :button-text="$primaryCta" :button-url="$whatsappUrl" :image="config('sophdata.images.banner')" />
