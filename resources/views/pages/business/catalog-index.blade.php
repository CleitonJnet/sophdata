@extends('layouts.site')

@section('title', ($catalog['title'] ?? 'Catálogo Empresarial') . ' | SophData')
@section('meta_description', $catalog['description'] ?? 'Catálogo empresarial SophData.')

@section('content')
    @php
        $cta = $catalog['cta'] ?? [];
        $ctaUrl = $cta['url'] ?? '/para-empresas/contato';
        $ctaPrimaryUrl = filled($cta['whatsapp_message'] ?? null)
            ? (sophdata_whatsapp_url($cta['whatsapp_message']) ?: $ctaUrl)
            : $ctaUrl;
        $copyBySlug = [
            'desenvolvimento-de-software' => [
                'pains_title' => 'Sua empresa ainda depende de processos manuais?',
                'pains_description' => 'Quando informações ficam espalhadas, a equipe perde tempo, a gestão perde clareza e o crescimento fica limitado.',
                'positioning_title' => 'Desenvolvimento pensado para a operação da empresa',
                'positioning_description' => 'Antes de escrever código, entendemos o problema, o fluxo de trabalho e o resultado esperado.',
                'logic_title' => 'Como este bloco organiza a operação',
                'logic_description' => 'A estrutura abaixo resume o papel deste conjunto de soluções dentro da empresa.',
                'categories_eyebrow' => 'Desenvolvimento de Software',
                'categories_title' => 'O que podemos desenvolver para sua empresa',
                'categories_description' => 'Escolha o caminho mais proximo da sua necessidade: presença digital, sistema interno, automação ou sustentação.',
                'method_title' => 'Como conduzimos um projeto de desenvolvimento',
                'method_description' => 'Um bom sistema comeca com clareza de escopo e termina com acompanhamento para contínuar util.',
                'packages_title' => 'Caminhos comerciais para começar',
                'packages_description' => 'A SophData pode começar com uma presença digital enxuta, um sistema administrativo ou uma plataforma em fases.',
                'rules_title' => 'Clareza antes de desenvolver',
                'rules_description' => 'Projetos digitais precisam de escopo, critérios de aceite e combinacao clara sobre o que está incluso.',
                'cta_title' => 'Quer tirar uma ideia do papel ou organizar um sistema existente?',
                'cta_description' => 'Solicite um diagnóstico digital. A SophData ajuda a entender se sua empresa precisa de site, sistema, automação, integração ou sustentação.',
                'cta_alt' => 'Desenvolvimento de Software SophData',
                'secondary_label' => 'Ver soluções de software',
                'secondary_url' => '#categorias',
            ],
            'infraestrutura-corporativa-gerenciada' => [
                'pains_title' => 'Sua empresa perde tempo com infraestrutura desorganizada?',
                'pains_description' => 'Quando computadores, rede e suporte funcionam no improviso, a operação perde produtividade e previsibilidade.',
                'positioning_title' => 'Infraestrutura pensada para a rotina da empresa',
                'positioning_description' => 'A SophData organiza a base tecnologica para que computadores, rede, Wi-Fi e suporte tenham mais previsibilidade.',
                'logic_title' => 'Como a infraestrutura se encaixa na operação',
                'logic_description' => 'Cada parte da infraestrutura cumpre um papel. Quando tudo esta organizado, a empresa trabalha melhor.',
                'categories_eyebrow' => 'Infraestrutura Corporativa Gerenciada',
                'categories_title' => 'A base de TI da sua empresa em ordem',
                'categories_description' => 'Organize computadores, rede, Wi-Fi e suporte mensal com uma estrutura mais previsível.',
                'packages_title' => 'Pacotes integrados por porte de empresa',
                'packages_description' => 'Para empresas que precisam organizar computadores, rede, Wi-Fi, servidor opcional, backup e suporte mensal em uma proposta mais clara.',
                'combinations_title' => 'Caminhos para começar com infraestrutura',
                'combinations_description' => 'A SophData pode iniciar com uma organização básica ou estruturar um ambiente gerenciado conforme a necessidade da empresa.',
                'monthly_title' => 'Administração mensal para manter o ambiente acompanhado',
                'monthly_description' => 'A infraestrutura precisa de continuidade. O suporte mensal reduz improvisos e ajuda a planejar melhorias.',
                'rules_title' => 'Escopo claro antes da implantação',
                'rules_description' => 'Infraestrutura envolve ambiente físico, equipamentos, licenças e operação. Por isso, cada proposta precisa ter limites bem definidos.',
                'cta_title' => 'Quer organizar a infraestrutura da sua empresa?',
                'cta_description' => 'Solicite um diagnóstico de infraestrutura. A SophData ajuda a avaliar computadores, rede, Wi-Fi, suporte e administração mensal conforme a realidade da sua operação.',
                'cta_alt' => 'Infraestrutura Corporativa Gerenciada SophData',
                'secondary_label' => 'Ver pacotes de infraestrutura',
                'secondary_url' => '/para-empresas/infraestrutura-corporativa-gerenciada/pacotes-integrados',
            ],
            'servidores-e-ambientes-corporativos' => [
                'pains_title' => 'Sua empresa tem arquivos, acessos e backup sob controle?',
                'pains_description' => 'Quando arquivos, permissões e backups ficam no improviso, a empresa trabalha com risco maior e menos continuidade.',
                'positioning_title' => 'Ambientes corporativos pensados para continuidade',
                'positioning_description' => 'A SophData organiza servidores, arquivos, permissões, backup e acesso remoto para que a empresa trabalhe com mais segurança operacional.',
                'logic_title' => 'Como os servidores sustentam a operação',
                'logic_description' => 'Cada recurso tem uma função: organizar, proteger, controlar acesso e manter a continuidade do ambiente.',
                'categories_eyebrow' => 'Servidores e Ambientes Corporativos',
                'categories_title' => 'Ambientes corporativos com mais controle e continuidade',
                'categories_description' => 'Centralize arquivos, organize permissões, proteja dados e prepare o ambiente para crescer com segurança.',
                'packages_title' => 'Caminhos recomendados para organizar seu ambiente',
                'packages_description' => 'Algumas empresas precisam começar por arquivos e backup. Outras precisam organizar usuários, permissões, VPN e administração mensal.',
                'monthly_title' => 'Implantação e acompanhamento contínuo',
                'monthly_description' => 'Servidores e ambientes corporativos precisam de implantação cuidadosa e acompanhamento para manter segurança, organização e continuidade.',
                'rules_title' => 'Ambiente corporativo exige escopo claro',
                'rules_description' => 'Servidores envolvem dados importantes, acesso de usuários, segurança e continuidade. Por isso, cada proposta deve ser feita com diagnóstico e limites bem definidos.',
                'cta_title' => 'Quer organizar servidores, arquivos ou backup da sua empresa?',
                'cta_description' => 'Solicite uma avaliação do ambiente. A SophData ajuda a entender o melhor caminho para centralizar arquivos, controlar acessos, proteger dados e estruturar trabalho remoto com mais segurança.',
                'cta_alt' => 'Servidores e Ambientes Corporativos SophData',
                'secondary_label' => 'Ver soluções de servidores',
                'secondary_url' => '#categorias',
            ],
        ];
        $sectionCopy = $copyBySlug[$catalog['slug'] ?? ''] ?? [
            'categories_eyebrow' => 'Catálogo empresarial',
            'categories_title' => $catalog['subtitle'] ?? 'Categorias do bloco',
            'categories_description' => 'Escolha a categoria que melhor representa a necessidade atual da empresa.',
            'packages_title' => 'Caminhos comerciais para começar',
            'packages_description' => 'Escolha um caminho inicial conforme o momento da empresa.',
            'rules_title' => 'Regras comerciais',
            'rules_description' => 'Cada proposta deve alinhar escopo, responsabilidades e limites antes da execucao.',
            'cta_title' => $cta['label'] ?? 'Solicitar atendimento empresarial',
            'cta_description' => $catalog['description'] ?? 'Converse com a SophData para avaliar o melhor caminho para sua empresa.',
            'cta_alt' => $catalog['title'] ?? 'SophData',
            'secondary_label' => 'Ver categorias',
            'secondary_url' => '#categorias',
        ];
        $methodSteps = collect($catalog['method'] ?? [])
            ->map(fn (array $step): array => [
                'title' => $step['title'] ?? '',
                'description' => $step['description'] ?? trim(($step['objective'] ?? '') . (filled($step['deliverables'] ?? null) ? ' Entrega: ' . $step['deliverables'] : '')),
            ])
            ->filter(fn (array $step): bool => filled($step['title']) || filled($step['description']))
            ->values();
        $commercialPackages = $catalog['combined_packages']
            ?? $catalog['commercial_packages']
            ?? $catalog['integrated_packages']
            ?? $catalog['recommended_bundles']
            ?? $catalog['commercial_bundles']
            ?? $catalog['bundles']
            ?? [];
        $commercialCombinations = collect($catalog['commercial_combinations'] ?? [])->take(3)->values();
        $adminCategory = collect($catalog['categories'] ?? [])->firstWhere('slug', 'administracao-mensal');
        $monthlyPlans = is_array($adminCategory) ? ($adminCategory['monthly_plans'] ?? []) : [];
        if (! filled($monthlyPlans) && ($catalog['slug'] ?? null) === 'servidores-e-ambientes-corporativos') {
            $monthlyPlans = collect($catalog['categories'] ?? [])
                ->flatMap(fn (array $category): array => collect($category['monthly_plans'] ?? [])
                    ->take(1)
                    ->map(fn (array $plan): array => [
                        ...$plan,
                        'source_category' => $category['title'] ?? null,
                    ])
                    ->all())
                ->take(4)
                ->values()
                ->all();
        }
        $commercialRules = array_slice($catalog['commercial_rules'] ?? [], 0, 5);
        $displayText = static fn ($value): ?string => is_scalar($value) ? (string) $value : null;
        $displayList = static fn ($value): array => is_array($value) ? $value : (filled($value) ? [(string) $value] : []);
        $heroSubtitle = trim(implode(' ', array_filter([
            $catalog['subtitle'] ?? null,
            $catalog['description'] ?? null,
        ])));
    @endphp

    <x-site.hero-banner eyebrow="Portal Para Empresas" :title="$catalog['title']" :subtitle="$heroSubtitle ?: ($catalog['description'] ?? $catalog['subtitle'] ?? '')"
        :primary-button-text="$cta['label'] ?? 'Solicitar diagnóstico'" :primary-button-url="$ctaPrimaryUrl"
        :secondary-button-text="$sectionCopy['secondary_label']" :secondary-button-url="$sectionCopy['secondary_url']" :image="$catalog['image']" :image-alt="$catalog['image_alt'] ?? $catalog['title']" />

    @if (filled($catalog['pains'] ?? []))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Dores de negócio" :title="$sectionCopy['pains_title'] ?? 'Problemas que este bloco ajuda a resolver'"
                    :description="$sectionCopy['pains_description'] ?? 'Entenda quais situações podem ser organizadas com esta frente de atendimento.'"
                    centered />
                <ul class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                    @foreach ($catalog['pains'] as $pain)
                        <li class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <span class="grid size-10 place-items-center rounded-full bg-brand-100 font-bold text-brand-700" aria-hidden="true">✓</span>
                            <p class="mt-5 font-semibold leading-7 text-brand-950">{{ $pain }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if (filled($catalog['positioning'] ?? []))
        <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Posicionamento" :title="$sectionCopy['positioning_title'] ?? 'Como esta frente apoia a empresa'"
                    :description="$sectionCopy['positioning_description'] ?? 'A organização do trabalho vem antes da escolha da solução.'"
                    centered />
                <ul class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($catalog['positioning'] as $item)
                        <li class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            @if (is_array($item))
                                <h3 class="text-lg font-bold text-brand-950">{{ $item['title'] ?? 'Ponto de apoio' }}</h3>
                                <p class="mt-3 leading-7 text-slate-600">{{ $item['description'] ?? '' }}</p>
                            @else
                                <p class="font-semibold leading-7 text-brand-950">{{ $item }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if (filled($catalog['logic'] ?? []))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Logica comercial" :title="$sectionCopy['logic_title'] ?? 'Como este bloco organiza a operação'"
                    :description="$sectionCopy['logic_description'] ?? 'A estrutura abaixo resume o papel deste conjunto de soluções dentro da empresa.'"
                    centered />
                <ul class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-5">
                    @foreach ($catalog['logic'] as $item)
                        <li class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <p class="font-semibold leading-7 text-brand-950">{{ $item }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <section id="categorias" class="scroll-mt-48 bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
            <x-site.section-heading :eyebrow="$sectionCopy['categories_eyebrow']" :title="$sectionCopy['categories_title']"
                :description="$sectionCopy['categories_description']" centered />
                <ul class="mt-12 grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($catalog['categories'] ?? [] as $category)
                    <li>
                        <x-site.category-card :title="$category['title']" :description="$category['subtitle'] ?? $category['description']" :image="$category['image']"
                            :url="$category['route'] ?? route($categoryRouteName, $category['slug'])" :items="array_slice($category['pains'] ?? [], 0, 3)"
                            :image-alt="$category['image_alt'] ?? null" cta-label="Conhecer categoria" />
                    </li>
                @endforeach
                </ul>
        </div>
    </section>

    @if ($methodSteps->isNotEmpty())
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Método" :title="$sectionCopy['method_title'] ?? 'Como conduzimos este trabalho'"
                    :description="$sectionCopy['method_description'] ?? 'Cada atendimento segue etapas claras para reduzir improviso e melhorar o resultado.'"
                    centered />
                <x-site.process-steps :steps="$methodSteps->all()" class="mt-12 lg:grid-cols-4" />
            </div>
        </section>
    @endif

    @if (filled($commercialPackages))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Pacotes comerciais" :title="$sectionCopy['packages_title']"
                    :description="$sectionCopy['packages_description']" centered />
                <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                    @foreach ($commercialPackages as $package)
                        @php
                            $packageTitle = $package['name'] ?? $package['title'] ?? 'Pacote empresarial';
                            $packageSummary = $displayText($package['includes'] ?? $package['description'] ?? null);
                            $packageLimits = $displayList($package['limits'] ?? $package['included_items'] ?? $package['includes'] ?? []);
                        @endphp
                        <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-brand-600">
                                {{ $package['best_for'] ?? $package['recommended_for'] ?? $package['profile'] ?? 'Indicado para empresas' }}
                            </p>
                            <h3 class="mt-3 text-xl font-bold text-brand-950">{{ $packageTitle }}</h3>
                            @if ($packageSummary)
                                <p class="mt-4 leading-7 text-slate-600">{{ $packageSummary }}</p>
                            @endif
                            @if (filled($packageLimits))
                                <ul class="mt-5 grid gap-2 text-sm text-slate-600">
                                    @foreach (array_slice($packageLimits, 0, 6) as $limit)
                                        <li class="flex gap-2">
                                            <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                            <span>{{ $limit }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="mt-5 grid gap-2 text-sm font-semibold text-brand-950">
                                @if (filled($package['starting_price'] ?? $package['initial_price'] ?? $package['price'] ?? null))
                                    <p>Implantação inicial: {{ $package['starting_price'] ?? $package['initial_price'] ?? $package['price'] }}</p>
                                @endif
                                @if (filled($package['suggested_monthly'] ?? $package['monthly_suggestion'] ?? $package['monthly_price'] ?? null))
                                    <p>Mensalidade: {{ $package['suggested_monthly'] ?? $package['monthly_suggestion'] ?? $package['monthly_price'] }}</p>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($commercialCombinations->isNotEmpty())
        <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Combinações comerciais" :title="$sectionCopy['combinations_title'] ?? 'Caminhos comerciais para começar'"
                    :description="$sectionCopy['combinations_description'] ?? 'A SophData pode iniciar com uma organização básica e evoluir conforme a necessidade da empresa.'"
                    centered />
                <div class="mt-12 grid gap-5 md:grid-cols-3">
                    @foreach ($commercialCombinations as $combination)
                        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-xl font-bold text-brand-950">{{ $combination['title'] ?? $combination['name'] ?? 'Combinacao empresarial' }}</h3>
                            <dl class="mt-5 grid gap-3 text-sm text-slate-600">
                                @foreach ($combination as $key => $value)
                                    @continue(in_array($key, ['title', 'name'], true) || is_array($value))
                                    <div>
                                        <dt class="font-bold text-brand-950">{{ ucfirst(str_replace('_', ' ', $key)) }}</dt>
                                        <dd class="mt-1">{{ $value }}</dd>
                                    </div>
                                @endforeach
                            </dl>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (filled($monthlyPlans))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Administração mensal" :title="$sectionCopy['monthly_title'] ?? 'Planos mensais para continuidade'"
                    :description="$sectionCopy['monthly_description'] ?? 'Acompanhamento recorrente reduz improviso e ajuda a planejar melhorias.'"
                    centered />
                <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                    @foreach ($monthlyPlans as $plan)
                        <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <h3 class="text-xl font-bold text-brand-950">{{ $plan['title'] ?? $plan['name'] ?? 'Plano mensal' }}</h3>
                            <div class="mt-5 grid gap-2 text-sm text-slate-600">
                                @if (filled($plan['source_category'] ?? null))
                                    <p><span class="font-bold text-brand-950">Frente:</span> {{ $plan['source_category'] }}</p>
                                @endif
                                @if (filled($plan['assets'] ?? $plan['machines'] ?? null))
                                    <p><span class="font-bold text-brand-950">Ativos:</span> {{ $plan['assets'] ?? $plan['machines'] }}</p>
                                @endif
                                @if (filled($plan['environment'] ?? $plan['attendance'] ?? null))
                                    <p><span class="font-bold text-brand-950">Ambiente:</span> {{ $plan['environment'] ?? $plan['attendance'] }}</p>
                                @endif
                                @foreach (array_slice($displayList($plan['includes'] ?? []), 0, 3) as $included)
                                    <p class="flex gap-2">
                                        <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                        <span>{{ $included }}</span>
                                    </p>
                                @endforeach
                            </div>
                            @if (filled($plan['price'] ?? null))
                                <p class="mt-5 text-sm font-bold text-brand-700">{{ $plan['price'] }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (filled($commercialRules))
        <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Regras comerciais" :title="$sectionCopy['rules_title']"
                    :description="$sectionCopy['rules_description']" centered />
                <ul class="mx-auto mt-12 grid max-w-5xl gap-4 md:grid-cols-2">
                    @foreach ($commercialRules as $rule)
                        <li class="flex gap-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <span class="grid size-10 shrink-0 place-items-center rounded-full bg-brand-100 font-bold text-brand-700" aria-hidden="true">✓</span>
                            <p class="font-semibold leading-7 text-brand-950">{{ $rule }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <x-site.cta-section :title="$sectionCopy['cta_title']" :description="$sectionCopy['cta_description']"
        :button-text="$cta['label'] ?? 'Solicitar diagnóstico'" :button-url="$ctaPrimaryUrl" :image="$catalog['image']"
        :image-alt="$sectionCopy['cta_alt']" />
@endsection
