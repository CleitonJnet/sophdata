@props([
    'portalContext' => null,
])

@php
    $isBusinessPortal = request()->routeIs('portal.business*');
    $isPersonalPortal = request()->routeIs('portal.personal*');
    $detectedPortalContext = $isBusinessPortal ? 'business' : ($isPersonalPortal ? 'personal' : 'neutral');
    $portalContext = in_array($portalContext, ['business', 'personal', 'neutral'], true)
        ? $portalContext
        : $detectedPortalContext;
    $activePortalKey = in_array($portalContext, ['business', 'personal'], true) ? $portalContext : null;
    $hasPortalContext = $activePortalKey !== null;
    $logoPortalKey = $activePortalKey ?? 'business';
    $portal = $hasPortalContext ? config("sophdata_portals.{$activePortalKey}") : null;
    $categories = $hasPortalContext ? config("sophdata_services.{$activePortalKey}", []) : [];
    $categories = $activePortalKey === 'business'
        ? collect($categories)
            ->sortBy(fn(array $category) => $category['slug'] === 'sites-e-sistemas' ? 0 : 1)
            ->values()
            ->all()
        : $categories;
    $categoryRoute = $hasPortalContext ? "portal.{$activePortalKey}.category" : null;
    $activeCategorySlug = request()->route('category');
    $isAboutPage = request()->routeIs('site.about');
    $isContactPage = request()->routeIs('site.contact');
    $whatsappUrl = sophdata_whatsapp_url('Olá, quero iniciar um atendimento com a SophData.');
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

<header class="relative border-b border-slate-200 bg-white shadow-sm" data-site-header>
    <div class="hidden bg-brand-950 text-white lg:block">
        <div class="mx-auto flex min-h-10 max-w-8xl items-center justify-between gap-6 px-8 text-xs">
            <p class="font-semibold text-brand-100">Soluções em TI para pessoas e empresas</p>
            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                class="rounded-md font-bold text-gold-light hover:text-white">
                Iniciar atendimento
            </a>
        </div>
    </div>

    <div class="relative z-60 mx-auto flex min-h-20 max-w-8xl items-center justify-between gap-4 bg-white px-4 py-3 sm:px-6 lg:px-8">
        <div class="flex min-w-0 items-center gap-4 lg:gap-6">
            <x-site.logo :portal="$logoPortalKey" class="shrink-0" />
            <x-site.portal-switcher :active-portal="$activePortalKey" compact class="hidden w-88 lg:grid" />
        </div>

        <nav class="hidden items-center gap-1 text-sm font-semibold text-slate-700 lg:flex"
            aria-label="Navegação principal">
            <a href="{{ route('site.about') }}"
                @if ($isAboutPage) aria-current="page" @endif
                @class([
                    'rounded-xl px-3 py-2.5 hover:bg-brand-50 hover:text-brand-800',
                    'bg-brand-50 text-brand-900' => $isAboutPage,
                ])>Sobre</a>
            <a href="{{ route('site.contact') }}"
                @if ($isContactPage) aria-current="page" @endif
                @class([
                    'rounded-xl px-3 py-2.5 hover:bg-brand-50 hover:text-brand-800',
                    'bg-brand-50 text-brand-900' => $isContactPage,
                ])>Contato</a>
            <x-whatsapp-link>Iniciar atendimento</x-whatsapp-link>
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

    <div id="mobile-navigation"
        class="fixed inset-0 z-50 hidden overflow-y-auto overscroll-contain border-t border-slate-200 bg-slate-50 px-4 pb-5 pt-24 shadow-2xl lg:hidden"
        data-mobile-menu>
        <div class="mx-auto grid min-h-full max-w-2xl content-start gap-5 pb-8">
            <section class="rounded-3xl border border-brand-100 bg-white p-4 shadow-sm"
                aria-label="Escolha de perfil">
                <x-site.portal-switcher :active-portal="$activePortalKey" compact />
            </section>

            @if ($hasPortalContext)
                <section class="rounded-3xl border border-slate-200 bg-white p-4 shadow-sm"
                    aria-labelledby="mobile-services-heading">
                    <div class="mb-3 flex items-center justify-between gap-4">
                        <h2 id="mobile-services-heading"
                            class="text-xs font-bold uppercase tracking-[0.16em] text-brand-700">
                            Serviços {{ $portal['label'] }}
                        </h2>
                        <a href="{{ route($portal['route']) }}"
                            class="text-xs font-bold text-brand-700 underline underline-offset-4">Ver todas</a>
                    </div>
                    <div class="grid gap-3">
                        @foreach ($categories as $category)
                            <x-site.service-menu-card :category="$category" :route-name="$categoryRoute" mobile />
                        @endforeach
                    </div>
                </section>
            @endif

            <nav class="grid gap-3 rounded-3xl border border-brand-100 bg-brand-50 p-4 shadow-sm"
                aria-label="Links institucionais móveis">
                <a href="{{ route('site.about') }}"
                    @if ($isAboutPage) aria-current="page" @endif
                    @class([
                        'flex min-h-16 items-center justify-between rounded-2xl border bg-white px-4 py-3 font-semibold text-slate-700 shadow-sm transition hover:border-brand-300 hover:text-brand-900',
                        'border-gold text-brand-900 ring-2 ring-gold/20' => $isAboutPage,
                        'border-slate-200' => !$isAboutPage,
                    ])>Sobre</a>
                <a href="{{ route('site.contact') }}"
                    @if ($isContactPage) aria-current="page" @endif
                    @class([
                        'flex min-h-16 items-center justify-between rounded-2xl border bg-white px-4 py-3 font-semibold text-slate-700 shadow-sm transition hover:border-brand-300 hover:text-brand-900',
                        'border-gold text-brand-900 ring-2 ring-gold/20' => $isContactPage,
                        'border-slate-200' => !$isContactPage,
                    ])>Contato</a>
            </nav>

            <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                class="inline-flex min-h-16 items-center justify-center rounded-3xl bg-action-500 px-6 py-4 text-center text-sm font-bold text-white shadow-lg shadow-action-500/20 hover:bg-action-600">
                Iniciar atendimento
            </a>
        </div>
    </div>
</header>
@if ($hasPortalContext)
    <div class="sticky top-0 z-999 hidden border-t border-slate-200 bg-brand-50 lg:block">
        <nav class="mx-auto flex h-14 max-w-8xl items-stretch gap-3 overflow-x-auto px-8 horizontal-scroll"
            aria-label="Serviços principais do portal ativo">
            @foreach ($categories as $category)
                @php
                    $isActiveCategory = $activeCategorySlug === $category['slug'];
                    $iconPaths = $serviceIcons[$category['slug']] ?? ['M4 12h16', 'M12 4v16'];
                @endphp
                <a href="{{ route($categoryRoute, $category['slug']) }}"
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
