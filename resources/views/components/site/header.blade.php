@php
    $navigation = config('sophdata.links');
    $personalCategories = config('sophdata.categories.personal');
    $businessCategories = config('sophdata.categories.business');
    $whatsappUrl = sophdata_whatsapp_url();
@endphp

<header class="sticky top-0 z-40 border-b border-slate-200 bg-white shadow-sm" data-site-header>
    <div class="hidden border-b border-brand-900 bg-brand-950 text-white lg:block">
        <div class="mx-auto flex h-9 max-w-7xl items-center justify-between px-8 text-xs">
            <p class="font-medium text-brand-100">Soluções em TI para pessoas e empresas</p>
            <nav class="flex items-center gap-6 font-semibold" aria-label="Links rápidos">
                <a href="{{ route('para-voce') }}" class="text-brand-100 transition hover:text-white">Para Você</a>
                <a href="{{ route('para-empresas') }}" class="text-brand-100 transition hover:text-white">Para Empresas</a>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="text-brand-200 transition hover:text-white">
                    Falar no WhatsApp
                </a>
            </nav>
        </div>
    </div>

    <div class="mx-auto flex h-18 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <x-brand />

        <nav class="hidden items-center gap-1 text-sm font-semibold text-slate-700 lg:flex" aria-label="Navegação principal">
            @foreach ($navigation as $item)
                <a
                    href="{{ route($item['route']) }}"
                    @class([
                        'rounded-xl px-4 py-2.5 transition hover:bg-brand-50 hover:text-brand-700',
                        'bg-brand-50 text-brand-700' => request()->routeIs($item['route']),
                    ])
                    @if (request()->routeIs($item['route'])) aria-current="page" @endif
                >
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="hidden lg:block">
            <x-whatsapp-link>Falar no WhatsApp</x-whatsapp-link>
        </div>

        <button
            type="button"
            class="grid size-12 place-items-center rounded-xl border border-slate-200 text-brand-950 transition hover:border-brand-200 hover:bg-brand-50 lg:hidden"
            aria-label="Abrir menu"
            aria-controls="mobile-navigation"
            aria-expanded="false"
            data-menu-button
        >
            <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M4 7h16M4 12h16M4 17h16"/>
            </svg>
        </button>
    </div>

    <div class="relative hidden border-t border-slate-100 lg:block">
        <nav class="mx-auto flex h-13 max-w-7xl items-center gap-2 px-8" aria-label="Navegação por perfil">
            <div class="h-full" data-mega-menu>
                <button
                    type="button"
                    class="flex h-full items-center gap-2 border-b-2 border-transparent px-4 text-sm font-bold text-brand-950 transition hover:border-brand-600 hover:text-brand-700"
                    aria-expanded="false"
                    aria-controls="mega-menu-personal"
                    data-mega-trigger
                >
                    Para Você
                    <svg viewBox="0 0 20 20" class="size-4 transition" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" data-mega-chevron>
                        <path d="m6 8 4 4 4-4"/>
                    </svg>
                </button>

                <div
                    id="mega-menu-personal"
                    class="absolute inset-x-0 top-full hidden max-h-[calc(100vh-10rem)] overflow-y-auto border-t border-slate-100 bg-white shadow-[0_22px_45px_-20px_rgba(15,35,75,.28)]"
                    data-mega-panel
                >
                    <div class="mx-auto grid max-w-7xl grid-cols-[240px_1fr] gap-10 px-8 py-8">
                        <div class="rounded-3xl bg-brand-950 p-6 text-white">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-brand-300">Para Você</p>
                            <p class="mt-3 text-2xl font-bold">Tecnologia para sua rotina</p>
                            <p class="mt-3 text-sm leading-6 text-brand-100/75">Suporte claro para sua casa, estudos, carreira e vida digital.</p>
                            <a href="{{ route('para-voce') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-brand-200 hover:text-white">
                                Ver todas as soluções <span aria-hidden="true">→</span>
                            </a>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach ($personalCategories as $category)
                                <a href="{{ route('para-voce').'#'.$category['slug'] }}" class="group rounded-2xl p-4 transition hover:bg-brand-50">
                                    <span class="block font-bold text-brand-950 group-hover:text-brand-700">{{ $category['title'] }}</span>
                                    <span class="mt-1 block text-sm leading-5 text-slate-500">{{ $category['eyebrow'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="h-full" data-mega-menu>
                <button
                    type="button"
                    class="flex h-full items-center gap-2 border-b-2 border-transparent px-4 text-sm font-bold text-brand-950 transition hover:border-brand-600 hover:text-brand-700"
                    aria-expanded="false"
                    aria-controls="mega-menu-business"
                    data-mega-trigger
                >
                    Para Empresas
                    <svg viewBox="0 0 20 20" class="size-4 transition" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true" data-mega-chevron>
                        <path d="m6 8 4 4 4-4"/>
                    </svg>
                </button>

                <div
                    id="mega-menu-business"
                    class="absolute inset-x-0 top-full hidden max-h-[calc(100vh-10rem)] overflow-y-auto border-t border-slate-100 bg-white shadow-[0_22px_45px_-20px_rgba(15,35,75,.28)]"
                    data-mega-panel
                >
                    <div class="mx-auto grid max-w-7xl grid-cols-[240px_1fr] gap-10 px-8 py-8">
                        <div class="rounded-3xl bg-brand-950 p-6 text-white">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-brand-300">Para Empresas</p>
                            <p class="mt-3 text-2xl font-bold">TI para o negócio avançar</p>
                            <p class="mt-3 text-sm leading-6 text-brand-100/75">Infraestrutura, segurança, sistemas e suporte para sua operação.</p>
                            <a href="{{ route('para-empresas') }}" class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-brand-200 hover:text-white">
                                Ver todas as soluções <span aria-hidden="true">→</span>
                            </a>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            @foreach ($businessCategories as $category)
                                <a href="{{ route('para-empresas').'#'.$category['slug'] }}" class="group rounded-2xl p-4 transition hover:bg-brand-50">
                                    <span class="block font-bold text-brand-950 group-hover:text-brand-700">{{ $category['title'] }}</span>
                                    <span class="mt-1 block text-sm leading-5 text-slate-500">{{ $category['eyebrow'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <nav
        id="mobile-navigation"
        class="hidden max-h-[calc(100dvh-4.5rem)] overflow-y-auto overscroll-contain border-t border-slate-200 bg-white px-4 py-4 pb-[max(1rem,env(safe-area-inset-bottom))] shadow-xl lg:hidden"
        data-mobile-menu
        aria-label="Navegação móvel"
    >
        <div class="mx-auto grid max-w-7xl gap-1">
            @foreach ($navigation as $item)
                @if (! in_array($item['route'], ['para-voce', 'para-empresas'], true))
                    <a
                        href="{{ route($item['route']) }}"
                        @class([
                            'flex min-h-12 items-center rounded-xl px-4 py-3 font-semibold text-slate-700 hover:bg-brand-50',
                            'bg-brand-50 text-brand-700' => request()->routeIs($item['route']),
                        ])
                    >
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach

            <details class="group rounded-xl border border-slate-200" @if (request()->routeIs('para-voce')) open @endif>
                <summary class="flex min-h-12 cursor-pointer list-none items-center justify-between rounded-xl px-4 py-3 font-bold text-brand-950 hover:bg-brand-50">
                    Para Você
                    <span class="text-brand-600 transition group-open:rotate-180" aria-hidden="true">⌄</span>
                </summary>
                <div class="grid gap-1 border-t border-slate-100 p-2">
                    <a href="{{ route('para-voce') }}" class="rounded-lg px-3 py-3 text-sm font-bold text-brand-700 hover:bg-brand-50">Ver todas as soluções</a>
                    @foreach ($personalCategories as $category)
                        <a href="{{ route('para-voce').'#'.$category['slug'] }}" class="rounded-lg px-3 py-3 text-sm text-slate-600 hover:bg-brand-50 hover:text-brand-700">
                            {{ $category['title'] }}
                        </a>
                    @endforeach
                </div>
            </details>

            <details class="group rounded-xl border border-slate-200" @if (request()->routeIs('para-empresas')) open @endif>
                <summary class="flex min-h-12 cursor-pointer list-none items-center justify-between rounded-xl px-4 py-3 font-bold text-brand-950 hover:bg-brand-50">
                    Para Empresas
                    <span class="text-brand-600 transition group-open:rotate-180" aria-hidden="true">⌄</span>
                </summary>
                <div class="grid gap-1 border-t border-slate-100 p-2">
                    <a href="{{ route('para-empresas') }}" class="rounded-lg px-3 py-3 text-sm font-bold text-brand-700 hover:bg-brand-50">Ver todas as soluções</a>
                    @foreach ($businessCategories as $category)
                        <a href="{{ route('para-empresas').'#'.$category['slug'] }}" class="rounded-lg px-3 py-3 text-sm text-slate-600 hover:bg-brand-50 hover:text-brand-700">
                            {{ $category['title'] }}
                        </a>
                    @endforeach
                </div>
            </details>

            <x-whatsapp-link class="mt-3 min-h-12 justify-center">Falar no WhatsApp</x-whatsapp-link>
        </div>
    </nav>
</header>
