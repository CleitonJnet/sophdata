@extends('layouts.site')

@section('title', ($category['title'] ?? 'Categoria Empresarial') . ' | SophData')
@section('meta_description', $category['description'] ?? 'Categoria empresarial SophData.')

@section('content')
    @php
        $parentTitle = $parentTitle ?? ($catalog['title'] ?? 'Catálogo empresarial');
        $parentUrl = $parentUrl ?? ($catalog['route'] ?? '/para-empresas');
        $fallbackCtas = config('sophdata_empresa.ctas', []);
        $defaultCta = match ($catalog['slug'] ?? null) {
            'desenvolvimento-de-software' => $fallbackCtas['software_diagnosis'] ?? [],
            'infraestrutura-corporativa-gerenciada' => $fallbackCtas['infrastructure_diagnosis'] ?? [],
            'servidores-e-ambientes-corporativos' => $fallbackCtas['servers_assessment'] ?? [],
            default => $fallbackCtas['business_diagnosis'] ?? [],
        };
        $cta = $category['cta'] ?? ($catalog['cta'] ?? $defaultCta);
        $ctaUrl = $cta['url'] ?? '/para-empresas/contato';
        $whatsappUrl = sophdata_whatsapp_url($cta['whatsapp_message'] ?? 'Olá! Quero atendimento empresarial com a SophData.');
        $primaryUrl = filled($cta['whatsapp_message'] ?? null) ? ($whatsappUrl ?: $ctaUrl) : $ctaUrl;
        $fallbackImage = $catalog['image'] ?? 'img/sophdata/portals/business-hero.webp';
        $categoryImage = $category['image'] ?? $fallbackImage;
        $imageExists = str_starts_with($categoryImage, 'http://')
            || str_starts_with($categoryImage, 'https://')
            || file_exists(public_path(ltrim($categoryImage, '/')));
        $heroImage = $imageExists ? $categoryImage : $fallbackImage;
        $relatedCategories = collect($catalog['categories'] ?? [])
            ->filter(fn ($item): bool => is_array($item) && ($item['slug'] ?? null) !== ($category['slug'] ?? null))
            ->take(4)
            ->values();
        $isInfrastructure = ($catalog['slug'] ?? null) === 'infraestrutura-corporativa-gerenciada';
        $isServers = ($catalog['slug'] ?? null) === 'servidores-e-ambientes-corporativos';
        $heroSubtitle = trim(implode(' ', array_filter([
            $category['subtitle'] ?? null,
            $category['description'] ?? null,
        ])));
        $serviceGroups = [
            [
                'key' => 'services',
                'eyebrow' => 'Serviços',
                'title' => 'O que pode entrar no escopo',
                'description' => 'Frentes de trabalho que ajudam a transformar a necessidade da empresa em uma solução mais organizada.',
            ],
            [
                'key' => 'diagnostic_services',
                'eyebrow' => 'Diagnóstico',
                'title' => 'Serviços de diagnóstico e avaliação',
                'description' => 'Análises pontuais para entender o ambiente antes de definir a melhor forma de organizar a infraestrutura.',
            ],
            [
                'key' => 'packages',
                'eyebrow' => 'Pacotes',
                'title' => 'Caminhos comerciais para começar',
                'description' => 'Opções iniciais para dimensionar investimento, prazo e expectativa de entrega.',
            ],
            [
                'key' => 'implementation_packages',
                'eyebrow' => 'Implantação',
                'title' => 'Pacotes de implantação',
                'description' => 'Estruturas de partida para colocar a solução em uso com mais previsibilidade.',
            ],
            [
                'key' => 'integrated_packages',
                'eyebrow' => 'Pacotes integrados',
                'title' => 'Infraestrutura organizada por porte de empresa',
                'description' => 'Caminhos para reunir computadores, rede, Wi-Fi, suporte e acompanhamento em uma proposta mais clara.',
            ],
            [
                'key' => 'monthly_plans',
                'eyebrow' => 'Planos mensais',
                'title' => 'Acompanhamento mensal',
                'description' => 'Planos para manter a operação assistida depois da entrega inicial.',
            ],
            [
                'key' => 'maintenance_plans',
                'eyebrow' => 'Manutenção',
                'title' => 'Planos de manutenção',
                'description' => 'Cuidados recorrentes para manter conteúdo, segurança e pequenas melhorias em dia.',
            ],
            [
                'key' => 'managed_environment_plans',
                'eyebrow' => 'Ambiente gerenciado',
                'title' => 'Planos de ambiente',
                'description' => 'Organização mensal para manter sites e sistemas publicados com acompanhamento.',
            ],
            [
                'key' => 'additional_modules',
                'eyebrow' => 'Módulos adicionais',
                'title' => 'Complementos sob demanda',
                'description' => 'Módulos que podem ampliar a solução conforme a rotina da empresa fica mais clara.',
            ],
            [
                'key' => 'segments',
                'eyebrow' => 'Segmentos',
                'title' => 'Soluções por tipo de operação',
                'description' => 'Pontos de partida para adaptar a proposta a segmentos com rotinas específicas.',
            ],
            [
                'key' => 'hour_banks',
                'eyebrow' => 'Banco de horas',
                'title' => 'Evolução com horas mensais',
                'description' => 'Reservas mensais para ajustes, melhorias e continuidade do sistema.',
            ],
        ];
        $detailsLabels = [
            'best_for' => 'Indicado para',
            'profile' => 'Perfil',
            'indicated_for' => 'Indicado para',
            'delivery' => 'Entrega',
            'criteria' => 'Criterio',
            'criterion' => 'Criterio',
            'limit' => 'Limite',
            'limits' => 'Limites',
            'deadline' => 'Prazo',
            'estimated_time' => 'Prazo estimado',
            'monthly_suggestion' => 'Mensalidade sugerida',
            'users' => 'Usuários',
            'machines' => 'Máquinas',
            'points' => 'Pontos',
            'área' => 'Área',
            'devices' => 'Dispositivos',
            'assets' => 'Ativos',
            'service_type' => 'Tipo de atendimento',
            'attendance' => 'Atendimento',
            'preventive' => 'Preventiva',
            'environment' => 'Ambiente',
            'computers' => 'Computadores',
            'remote_users' => 'Usuários remotos',
            'virtual_machines' => 'Máquinas virtuais',
            'storage' => 'Armazenamento',
            'tier' => 'Nível',
            'when_to_use' => 'Quando usar',
            'solution' => 'Solução',
            'starting_price' => 'Investimento inicial',
            'initial_price' => 'Implantação inicial',
            'initial_implementation' => 'Implantação inicial',
            'initial_total' => 'Total inicial',
            'suggested_maintenance' => 'Manutenção sugerida',
            'monthly_limit' => 'Limite mensal',
            'monthly_price' => 'Mensalidade',
            'monthly_total' => 'Total mensal',
            'hours' => 'Horas',
            'hours_per_month' => 'Horas por mes',
            'recommended_use' => 'Uso recomendado',
            'recommended_for' => 'Indicado para',
            'need' => 'Necessidade',
            'suggested_package' => 'Pacote sugerido',
            'implementation' => 'Implantação',
            'maintenance' => 'Manutenção',
            'inventory' => 'Inventario',
            'documentation' => 'Documentação',
            'wired_network' => 'Rede cabeada',
            'wifi' => 'Wi-Fi',
            'administration' => 'Administração',
            'details' => 'Detalhes',
            'effective_hour_value' => 'Valor efetivo da hora',
            'effective_hourly_rate' => 'Valor efetivo da hora',
            'includes' => 'Inclui',
            'price' => 'Investimento',
        ];
        $textValue = static fn ($value): ?string => is_scalar($value) ? (string) $value : null;
        $listValue = static fn ($value): array => is_array($value) ? $value : (filled($value) ? [(string) $value] : []);
    @endphp

    <nav aria-label="Breadcrumb" class="border-b border-slate-200 bg-white">
        <ol class="mx-auto flex min-h-12 max-w-8xl flex-wrap items-center gap-2 px-4 py-3 text-sm sm:px-6 lg:px-8">
            <li>
                <a href="{{ $parentUrl }}"
                    class="rounded-md font-semibold text-brand-700 underline underline-offset-4 transition hover:text-brand-900 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2">
                    &larr; Voltar para {{ $parentTitle }}
                </a>
            </li>
            <li aria-hidden="true" class="hidden select-none text-slate-400 sm:inline">/</li>
            <li aria-current="page" class="font-semibold text-slate-600">{{ $category['title'] }}</li>
        </ol>
    </nav>

    <x-site.hero-banner eyebrow="Portal Para Empresas" :title="$category['title']" :subtitle="$heroSubtitle ?: ($category['description'] ?? $category['subtitle'] ?? null)"
        :primary-button-text="$cta['label'] ?? 'Solicitar diagnóstico'" :primary-button-url="$primaryUrl" secondary-button-text="Ver opções"
        secondary-button-url="#opcoes" :image="$heroImage" :image-alt="$category['image_alt'] ?? $category['title']" />

    @if (filled($category['pains'] ?? []))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Dores atendidas" title="Problemas que essa solução ajuda a resolver"
                    :description="$isInfrastructure ? 'A infraestrutura deve sustentar a rotina da empresa, não criar interrupcoes constantes.' : ($isServers ? 'O ambiente corporativo deve proteger informações, organizar acessos e dar continuidade para a operação.' : 'Antes de contratar tecnologia, e importante entender qual dor ela precisa resolver.')"
                    centered />
                <ul class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($category['pains'] as $pain)
                        <li class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <span class="grid size-10 place-items-center rounded-full bg-brand-100 font-bold text-brand-700" aria-hidden="true">✓</span>
                            <p class="mt-5 font-semibold leading-7 text-brand-950">{{ $pain }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <div id="opcoes" class="scroll-mt-48">
        @foreach ($serviceGroups as $group)
            @php $items = $category[$group['key']] ?? []; @endphp
            @if (filled($items))
                <section @class([
                    'py-16 sm:py-20 lg:py-24',
                    'bg-brand-50' => $loop->odd,
                    'bg-white' => $loop->even,
                ])>
                    <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                        <x-site.section-heading :eyebrow="$group['eyebrow']" :title="$group['title']" :description="$group['description']" centered />
                        <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                            @foreach ($items as $item)
                                @php
                                    $item = is_array($item) ? $item : ['name' => $item];
                                    $title = $item['name'] ?? $item['title'] ?? $item['segment'] ?? 'Opcao';
                                    $summary = $textValue($item['description'] ?? $item['includes'] ?? null);
                                    $featuredDetail = $textValue($item['best_for'] ?? $item['recommended_for'] ?? $item['profile'] ?? $item['indicated_for'] ?? $item['recommended_use'] ?? null);
                                @endphp
                                <article class="flex h-full flex-col rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                                    @if (filled($featuredDetail))
                                        <p class="text-xs font-bold uppercase tracking-[0.16em] text-brand-600">
                                            {{ $featuredDetail }}
                                        </p>
                                    @endif
                                    <h3 class="mt-3 text-xl font-bold text-brand-950">{{ $title }}</h3>
                                    @if (filled($summary))
                                        <p class="mt-4 leading-7 text-slate-600">{{ $summary }}</p>
                                    @endif
                                    <div class="mt-5 grid gap-3 text-sm text-slate-600">
                                        @foreach ($detailsLabels as $key => $label)
                                            @continue(! filled($item[$key] ?? null))
                                            @continue(in_array($key, ['best_for', 'recommended_for', 'profile', 'indicated_for', 'recommended_use'], true) && $item[$key] === $featuredDetail)
                                            @continue($key === 'description')
                                            @continue($key === 'includes' && ! is_array($item[$key]))
                                            @if (is_array($item[$key]))
                                                <div>
                                                    <p class="font-bold text-brand-950">{{ $label }}:</p>
                                                    <ul class="mt-2 grid gap-2">
                                                        @foreach ($item[$key] as $detail)
                                                            <li class="flex gap-2">
                                                                <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                                                <span>{{ $detail }}</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @else
                                                <p>
                                                    <span class="font-bold text-brand-950">{{ $label }}:</span>
                                                    {{ $item[$key] }}
                                                </p>
                                            @endif
                                        @endforeach
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    </div>

    @if (filled($category['implementation_includes'] ?? $category['included_items'] ?? []))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Itens inclusos" title="O que pode incluir na implantação"
                    description="Uma implantação bem combinada ajuda a reduzir improvisos, organizar a entrega e deixar o ambiente mais previsível." centered />
                <ul class="mx-auto mt-12 grid max-w-5xl gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach (($category['implementation_includes'] ?? $category['included_items'] ?? []) as $item)
                        <li class="flex gap-3 rounded-3xl border border-slate-200 bg-slate-50 p-5 shadow-sm">
                            <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                            <p class="font-semibold leading-7 text-brand-950">{{ $item }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if (filled($category['recommended_profiles'] ?? []))
        <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Perfis indicados" title="Perfis de empresa que costumam se encaixar"
                    description="Esses exemplos ajudam a aproximar a solução da rotina real da empresa, sem substituir o diagnóstico." centered />
                <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($category['recommended_profiles'] as $profile)
                        @php
                            $profile = is_array($profile) ? $profile : ['name' => $profile];
                            $profileTitle = $profile['name'] ?? $profile['title'] ?? $profile['profile'] ?? 'Perfil indicado';
                        @endphp
                        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-xl font-bold text-brand-950">{{ $profileTitle }}</h3>
                            <div class="mt-5 grid gap-3 text-sm text-slate-600">
                                @foreach ($detailsLabels as $key => $label)
                                    @continue(! filled($profile[$key] ?? null))
                                    @continue(in_array($key, ['name', 'title'], true))
                                    @if (is_array($profile[$key]))
                                        <div>
                                            <p class="font-bold text-brand-950">{{ $label }}:</p>
                                            <ul class="mt-2 grid gap-2">
                                                @foreach ($profile[$key] as $detail)
                                                    <li class="flex gap-2">
                                                        <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                                        <span>{{ $detail }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <p>
                                            <span class="font-bold text-brand-950">{{ $label }}:</span>
                                            {{ $profile[$key] }}
                                        </p>
                                    @endif
                                @endforeach
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (filled($category['commercial_combinations'] ?? []))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Combinações comerciais" title="Caminhos de contratação"
                    description="Combinações simples ajudam a visualizar implantação, acompanhamento e continuidade em uma proposta mais clara." centered />
                <div class="mt-12 grid gap-5 md:grid-cols-3">
                    @foreach ($category['commercial_combinations'] as $combination)
                        @php
                            $combination = is_array($combination) ? $combination : ['name' => $combination];
                            $combinationTitle = $combination['name'] ?? $combination['title'] ?? 'Combinacao comercial';
                        @endphp
                        <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <h3 class="text-xl font-bold text-brand-950">{{ $combinationTitle }}</h3>
                            <dl class="mt-5 grid gap-3 text-sm text-slate-600">
                                @foreach ($detailsLabels as $key => $label)
                                    @continue(! filled($combination[$key] ?? null))
                                    @continue(in_array($key, ['name', 'title'], true))
                                    @if (is_array($combination[$key]))
                                        <div>
                                            <dt class="font-bold text-brand-950">{{ $label }}</dt>
                                            <dd class="mt-1">{{ implode(', ', $combination[$key]) }}</dd>
                                        </div>
                                    @else
                                        <div>
                                            <dt class="font-bold text-brand-950">{{ $label }}</dt>
                                            <dd class="mt-1">{{ $combination[$key] }}</dd>
                                        </div>
                                    @endif
                                @endforeach
                            </dl>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @php
        $notIncluded = $category['not_included'] ?? ($isServers ? ($catalog['not_included'] ?? []) : []);
    @endphp

    @if (filled($category['commercial_notes'] ?? []) || filled($category['scope_limits'] ?? []) || filled($notIncluded))
        <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Combinados comerciais" title="Observações importantes"
                    description="Valores e escopo podem variar conforme diagnóstico, porte do ambiente, equipamentos existentes e materiais necessários." centered />
                <div class="mt-12 grid gap-5 lg:grid-cols-2">
                    @foreach (['Observações comerciais' => $category['commercial_notes'] ?? [], 'Limites de escopo' => $category['scope_limits'] ?? [], 'Não incluso por padrao' => $notIncluded] as $title => $notes)
                        @if (filled($notes))
                            <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                                <h3 class="text-xl font-bold text-brand-950">{{ $title }}</h3>
                                <ul class="mt-5 grid gap-3 text-slate-600">
                                    @foreach (array_slice($notes, 0, 8) as $note)
                                        <li class="flex gap-3">
                                            <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                            <span>{{ $note }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </article>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if ($relatedCategories->isNotEmpty())
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="{{ $parentTitle }}" :title="$isInfrastructure ? 'Outras soluções de Infraestrutura Corporativa Gerenciada' : ($isServers ? 'Outras soluções de Servidores e Ambientes Corporativos' : 'Categorias relacionadas')"
                    description="Outras frentes que podem complementar essa necessidade dentro do mesmo bloco empresarial." centered />
                <nav class="mt-12" aria-label="Categorias relacionadas">
                    <ul class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($relatedCategories as $related)
                        <li>
                            <x-site.category-card :title="$related['title']" :description="$related['subtitle'] ?? $related['description']" :image="$related['image'] ?? $heroImage"
                                :url="$related['route'] ?? $parentUrl" :items="array_slice($related['pains'] ?? [], 0, 3)" :image-alt="$related['image_alt'] ?? null" cta-label="Conhecer categoria" />
                        </li>
                    @endforeach
                    </ul>
                </nav>
            </div>
        </section>
    @endif

    <x-site.cta-section :title="$cta['label'] ?? 'Solicitar diagnóstico empresarial'"
        :description="$category['subtitle'] ?? $category['description'] ?? 'Converse com a SophData para entender o melhor caminho para organizar essa necessidade da empresa.'"
        :button-text="$cta['label'] ?? 'Solicitar diagnóstico'" :button-url="$primaryUrl" :image="$heroImage" :image-alt="$category['image_alt'] ?? $category['title']" />
@endsection
