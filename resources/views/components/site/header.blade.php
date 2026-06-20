@props([
    'portalContext' => null,
])

@php
    $isBusinessPortal = request()->routeIs('portal.business*') || request()->routeIs('business.*');
    $isPersonalPortal = request()->routeIs('portal.personal*');
    $detectedPortalContext = $isBusinessPortal ? 'business' : ($isPersonalPortal ? 'personal' : 'neutral');
    $portalContext = in_array($portalContext, ['business', 'personal', 'neutral'], true)
        ? $portalContext
        : $detectedPortalContext;
    $activePortalKey = in_array($portalContext, ['business', 'personal'], true) ? $portalContext : null;
    $hasPortalContext = $activePortalKey !== null;
    $logoPortalKey = $activePortalKey ?? 'business';
    $portal = $hasPortalContext ? config("sophdata_portals.{$activePortalKey}") : null;
    $categories = [];

    if ($activePortalKey === 'business') {
        $businessMenuDescriptions = [
            'desenvolvimento-de-software' => 'Sites, sistemas, automações e soluções digitais.',
            'infraestrutura-corporativa-gerenciada' => 'Computadores, rede, Wi-Fi e suporte mensal.',
            'servidores-e-ambientes-corporativos' => 'Arquivos, permissões, backup e ambientes corporativos.',
            'planos' => 'Planos e pacotes empresariais.',
            'como-trabalhamos' => 'Método de diagnóstico, proposta e implantação.',
            'contato' => 'Solicite atendimento empresarial.',
        ];

        $categories = collect(config('sophdata_empresa_menu', []))
            ->filter(fn($item): bool => is_array($item))
            ->map(fn(array $item): array => [
                'slug' => $item['slug'],
                'title' => $item['label'],
                'menu_title' => $item['label'],
                'menu_description' => $businessMenuDescriptions[$item['slug']] ?? $item['label'],
                'route' => $item['route'],
            ])
            ->values()
            ->all();
    } elseif ($activePortalKey === 'personal') {
        $categories = [
            ...config('sophdata_services.personal', []),
            [
                'slug' => 'contato',
                'title' => 'Contato',
                'menu_title' => 'Contato',
                'menu_description' => 'Inicie atendimento para tecnologia pessoal.',
                'route' => '/para-voce/contato',
                'menu_image' => config('sophdata.images.banner'),
                'mobile_image' => config('sophdata.images.banner'),
                'image_alt' => 'Contato para atendimento pessoal SophData',
            ],
        ];
    }

    $categoryRoute = $hasPortalContext ? "portal.{$activePortalKey}.category" : null;
    $activeCategorySlug = request()->route('category');
    $currentPath = '/'.trim(request()->path(), '/');
    $isAboutPage = request()->routeIs('site.about');
    $whatsappMessage = match ($activePortalKey) {
        'business' => config('sophdata.whatsapp_messages.business'),
        'personal' => config('sophdata.whatsapp_messages.personal'),
        default => config('sophdata.whatsapp_messages.neutral'),
    };
    $whatsappFallbackUrl = match ($activePortalKey) {
        'business' => route('business.contact'),
        'personal' => route('personal.contact'),
        default => route('portal.choose'),
    };
    $whatsappUrl = sophdata_whatsapp_url($whatsappMessage) ?: $whatsappFallbackUrl;
    $isWhatsappExternal = str_starts_with($whatsappUrl, 'https://wa.me/');
    $serviceIcons = [
        'suporte-de-ti' => [
            'M9.75 17 9 21h6l-.75-4',
            'M4 5.75A2.75 2.75 0 0 1 6.75 3h10.5A2.75 2.75 0 0 1 20 5.75v7.5A2.75 2.75 0 0 1 17.25 16H6.75A2.75 2.75 0 0 1 4 13.25v-7.5Z',
        ],
        'redes-e-wifi' => [
            'M5 9.5a10 10 0 0 1 14 0',
            'M8 12.5a5.7 5.7 0 0 1 8 0',
            'M11 15.5a1.5 1.5 0 0 1 2 0',
            'M12 19h.01',
        ],
        'seguranca-e-backup' => ['M12 21s7-3.5 7-10V5.8L12 3 5 5.8V11c0 6.5 7 10 7 10Z', 'M9.5 12.3 11.2 14l3.5-4'],
        'sites-e-sistemas' => [
            'M4 6.75A2.75 2.75 0 0 1 6.75 4h10.5A2.75 2.75 0 0 1 20 6.75v10.5A2.75 2.75 0 0 1 17.25 20H6.75A2.75 2.75 0 0 1 4 17.25V6.75Z',
            'M4.5 8h15',
            'm10 12-2 2 2 2',
            'm14 12 2 2-2 2',
        ],
        'automacao-e-dados' => [
            'M5 6.5C5 5.12 8.13 4 12 4s7 1.12 7 2.5S15.87 9 12 9 5 7.88 5 6.5Z',
            'M5 6.5v5c0 1.38 3.13 2.5 7 2.5s7-1.12 7-2.5v-5',
            'M5 11.5v5c0 1.38 3.13 2.5 7 2.5s7-1.12 7-2.5v-5',
        ],
        'computadores-corporativos' => [
            'M4 5.75A2.75 2.75 0 0 1 6.75 3h10.5A2.75 2.75 0 0 1 20 5.75v8.5A2.75 2.75 0 0 1 17.25 17H6.75A2.75 2.75 0 0 1 4 14.25v-8.5Z',
            'M9 21h6',
            'M12 17v4',
        ],
        'desenvolvimento-de-software' => [
            'M4 6.75A2.75 2.75 0 0 1 6.75 4h10.5A2.75 2.75 0 0 1 20 6.75v10.5A2.75 2.75 0 0 1 17.25 20H6.75A2.75 2.75 0 0 1 4 17.25V6.75Z',
            'M4.5 8h15',
            'm10 12-2 2 2 2',
            'm14 12 2 2-2 2',
        ],
        'infraestrutura-corporativa-gerenciada' => [
            'M9.75 17 9 21h6l-.75-4',
            'M4 5.75A2.75 2.75 0 0 1 6.75 3h10.5A2.75 2.75 0 0 1 20 5.75v7.5A2.75 2.75 0 0 1 17.25 16H6.75A2.75 2.75 0 0 1 4 13.25v-7.5Z',
        ],
        'servidores-e-ambientes-corporativos' => [
            'M12 21s7-3.5 7-10V5.8L12 3 5 5.8V11c0 6.5 7 10 7 10Z',
            'M9.5 12.3 11.2 14l3.5-4',
        ],
        'planos' => [
            'M5 4h14v16H5z',
            'M8 8h8',
            'M8 12h8',
            'M8 16h5',
        ],
        'como-trabalhamos' => [
            'M4 7h4v4H4z',
            'M10 9h10',
            'M4 15h4v4H4z',
            'M10 17h10',
        ],
        'contato' => [
            'M4 6h16v12H4z',
            'm4 7 4 4 4-4',
        ],
        'computador-lento' => [
            'M4 5.75A2.75 2.75 0 0 1 6.75 3h10.5A2.75 2.75 0 0 1 20 5.75v7.5A2.75 2.75 0 0 1 17.25 16H6.75A2.75 2.75 0 0 1 4 13.25v-7.5Z',
            'M8 20h8',
            'M12 16v4',
            'm8.5 8.5 2 2 5-5',
        ],
        'wifi-e-casa-conectada' => [
            'M3.75 11.5 12 5l8.25 6.5',
            'M5.75 10.25V20h12.5v-9.75',
            'M9.5 15.5a3.5 3.5 0 0 1 5 0',
            'M12 18.5h.01',
        ],
        'backup-e-seguranca' => ['M12 21s7-3.5 7-10V5.8L12 3 5 5.8V11c0 6.5 7 10 7 10Z', 'M8.5 13.5h7', 'M8.5 10.5h7'],
        'estudos-carreira-e-ia' => [
            'M5 5.75A2.75 2.75 0 0 1 7.75 3H19v15H7.75A2.75 2.75 0 0 0 5 20.75v-15Z',
            'M8 7h7',
            'M8 10h5',
            'M16.5 13.5l.55 1.2 1.2.55-1.2.55-.55 1.2-.55-1.2-1.2-.55 1.2-.55.55-1.2Z',
        ],
        'montagem-e-upgrade-de-pc' => [
            'M8 4h8v4H8z',
            'M5 11h14v7H5z',
            'M8 21h8',
            'M12 18v3',
            'M8 14h.01M11 14h.01M14 14h.01',
        ],
    ];
@endphp

<div class="sticky top-0 z-1000 transition-transform duration-300 ease-in-out will-change-transform"
    data-site-header-shell>
    <header class="relative border-b border-slate-200 bg-white shadow-sm" data-site-header>
        <div class="hidden bg-brand-950 text-white lg:block">
            <div class="mx-auto flex min-h-10 max-w-8xl items-center justify-between gap-6 px-8 text-xs">
                <p class="font-semibold text-brand-100">Soluções em TI para pessoas e empresas</p>
                @if ($whatsappUrl)
                    <a href="{{ $whatsappUrl }}" @if ($isWhatsappExternal) target="_blank" rel="noopener noreferrer" @endif
                        class="rounded-md font-bold text-gold-light hover:text-white">
                        Iniciar atendimento
                    </a>
                @endif
            </div>
        </div>

        <div
            class="relative z-60 mx-auto flex min-h-20 max-w-8xl items-center justify-between gap-4 bg-white px-4 py-3 sm:px-6 lg:px-8">
            <div class="flex min-w-0 items-center gap-4 lg:gap-6">
                <x-site.logo :portal="$logoPortalKey" class="shrink-0" />
                <x-site.portal-switcher :active-portal="$activePortalKey" compact class="hidden w-88 lg:grid" />
            </div>

            <nav class="hidden items-center gap-1 text-sm font-semibold text-slate-700 lg:flex"
                aria-label="Navegação principal">
                <a href="{{ route('site.about') }}" @if ($isAboutPage) aria-current="page" @endif
                    @class([
                        'rounded-xl px-3 py-2.5 hover:bg-brand-50 hover:text-brand-800',
                        'bg-brand-50 text-brand-900' => $isAboutPage,
                    ])>Sobre</a>
                <x-whatsapp-link :message="$whatsappMessage" :fallback-url="$whatsappFallbackUrl">Iniciar atendimento</x-whatsapp-link>
            </nav>

            <button type="button"
                class="relative z-60 grid size-12 shrink-0 place-items-center rounded-xl border border-slate-300 bg-white text-brand-950 shadow-sm transition hover:border-brand-400 hover:bg-brand-50 lg:hidden"
                aria-label="Abrir menu" aria-controls="mobile-navigation" aria-expanded="false" data-menu-button>
                <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="2"
                    aria-hidden="true" data-menu-open-icon>
                    <path d="M4 7h16M4 12h16M4 17h16" />
                </svg>
                <svg viewBox="0 0 24 24" class="hidden size-6" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" aria-hidden="true" data-menu-close-icon>
                    <path d="M6 6l12 12M18 6 6 18" />
                </svg>
            </button>
        </div>

    </header>
    @if ($hasPortalContext)
        <div class="hidden border-t border-slate-200 bg-brand-50 lg:block" data-site-service-nav>
            <nav class="mx-auto flex h-14 max-w-8xl items-stretch gap-3 overflow-x-auto px-8 horizontal-scroll"
                aria-label="Serviços principais do portal ativo">
                @foreach ($categories as $category)
                    @php
                        $categoryUrl = $activePortalKey === 'business'
                            ? $category['route']
                            : ($category['route'] ?? route($categoryRoute, $category['slug']));
                        $isActiveCategory = $activePortalKey === 'business'
                            ? ($currentPath === $categoryUrl || str_starts_with($currentPath, $categoryUrl.'/'))
                            : (($currentPath === $categoryUrl || str_starts_with($currentPath, $categoryUrl.'/')) || $activeCategorySlug === $category['slug']);
                        $iconPaths = $serviceIcons[$category['slug']] ?? ['M4 12h16', 'M12 4v16'];
                    @endphp
                    <a href="{{ $categoryUrl }}"
                        @if ($isActiveCategory) aria-current="page" @endif @class([
                            'group relative inline-flex h-full shrink-0 items-center gap-2.5 px-3 text-sm transition after:absolute after:inset-x-3 after:bottom-0 after:h-0.5 after:origin-left after:rounded-full after:transition',
                            'bg-white font-bold text-brand-950 after:scale-x-100 after:bg-brand-800' => $isActiveCategory,
                            'font-semibold text-brand-950/75 after:scale-x-0 after:bg-brand-500 hover:bg-white/60 hover:text-brand-950 hover:after:scale-x-100' => !$isActiveCategory,
                        ])>
                        <svg viewBox="0 0 24 24" @class([
                            'size-4.5 shrink-0 transition',
                            'text-brand-800' => $isActiveCategory,
                            'text-brand-950/55 group-hover:text-brand-700' => !$isActiveCategory,
                        ]) fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            @foreach ($iconPaths as $path)
                                <path d="{{ $path }}" />
                            @endforeach
                        </svg>
                        {{ $category['menu_title'] ?? $category['title'] }}
                        @if ($isActiveCategory)
                            <span class="sr-only">Serviço ativo</span>
                        @endif
                    </a>
                @endforeach
            </nav>
        </div>
    @endif
</div>

<div id="mobile-navigation"
    class="fixed inset-x-0 bottom-0 top-(--site-mobile-menu-top,5rem) z-900 hidden overflow-y-auto overscroll-contain border-t border-slate-200 bg-slate-50 px-4 pb-[max(1.25rem,env(safe-area-inset-bottom))] pt-4 shadow-2xl lg:hidden"
    data-mobile-menu>
    <div class="mx-auto grid min-h-full max-w-2xl content-start gap-4 pb-8">
        <section class="rounded-3xl border border-brand-100 bg-white p-4 shadow-sm" aria-label="Escolha de perfil">
            <x-site.portal-switcher :active-portal="$activePortalKey" compact />
        </section>

        @if ($hasPortalContext)
            <nav class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm"
                aria-labelledby="mobile-services-heading">
                <div class="mb-3 flex items-center justify-between gap-4">
                    <h2 id="mobile-services-heading"
                        class="text-xs font-bold uppercase tracking-[0.16em] text-brand-700">
                        Serviços {{ $portal['label'] }}
                    </h2>
                    <a href="{{ route($portal['route']) }}"
                        class="text-xs font-bold text-brand-700 underline underline-offset-4">Ver todas</a>
                </div>
                <ul class="grid gap-3">
                    @foreach ($categories as $category)
                        <li>
                        @if ($activePortalKey === 'business')
                            @php
                                $categoryUrl = $category['route'];
                                $isActiveCategory = $currentPath === $categoryUrl || str_starts_with($currentPath, $categoryUrl.'/');
                            @endphp
                            <a href="{{ $categoryUrl }}"
                                @if ($isActiveCategory) aria-current="page" @endif @class([
                                    'group rounded-2xl transition focus-visible:outline-none flex min-h-16 items-center justify-between border bg-white px-4 py-3 font-semibold shadow-sm hover:border-brand-300 hover:bg-brand-50',
                                    'border-gold text-brand-900 ring-2 ring-gold/20' => $isActiveCategory,
                                    'border-slate-200 text-slate-700' => !$isActiveCategory,
                                ])>
                                <span>
                                    <strong class="block text-sm text-brand-950">{{ $category['menu_title'] }}</strong>
                                    <span class="mt-1 line-clamp-2 block text-xs leading-5 text-slate-500">{{ $category['menu_description'] }}</span>
                                    @if ($isActiveCategory)
                                        <span class="mt-1 block text-xs font-bold text-brand-700">Item ativo</span>
                                    @endif
                                </span>
                                <span class="text-brand-700" aria-hidden="true">→</span>
                            </a>
                        @else
                            <x-site.service-menu-card :category="$category" :route-name="isset($category['route']) ? null : $categoryRoute" mobile />
                        @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
        @endif

        <nav class="grid gap-3 rounded-3xl border border-brand-100 bg-brand-50 p-4 shadow-sm"
            aria-label="Links institucionais móveis">
            <a href="{{ route('site.about') }}" @if ($isAboutPage) aria-current="page" @endif
                @class([
                    'flex min-h-16 items-center justify-between rounded-2xl border bg-white px-4 py-3 font-semibold text-slate-700 shadow-sm transition hover:border-brand-300 hover:text-brand-900',
                    'border-gold text-brand-900 ring-2 ring-gold/20' => $isAboutPage,
                    'border-slate-200' => !$isAboutPage,
                ])>Sobre</a>
        </nav>

        @if ($whatsappUrl)
            <a href="{{ $whatsappUrl }}" @if ($isWhatsappExternal) target="_blank" rel="noopener noreferrer" @endif
                class="inline-flex min-h-16 items-center justify-center rounded-3xl bg-action-500 px-6 py-4 text-center text-sm font-bold text-white shadow-lg shadow-action-500/20 hover:bg-action-600">
                Iniciar atendimento
            </a>
        @endif
    </div>
</div>
