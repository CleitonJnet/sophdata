@extends('layouts.site')

@section('title', ($plans['title'] ?? 'Planos Empresariais') . ' | SophData')
@section('meta_description', $plans['description'] ?? 'Planos empresariais SophData.')

@section('content')
    @php
        $cta = $plans['cta'] ?? [];
        $ctaUrl = $cta['url'] ?? '/para-empresas/contato';
        $ctaPrimaryUrl = filled($cta['whatsapp_message'] ?? null)
            ? (sophdata_whatsapp_url($cta['whatsapp_message']) ?: $ctaUrl)
            : $ctaUrl;
        $heroSubtitle = trim(implode(' ', array_filter([
            $plans['subtitle'] ?? null,
            $plans['description'] ?? null,
        ])));
        $groups = $plans['groups'] ?? [];
        $displayList = static fn ($value): array => is_array($value) ? $value : (filled($value) ? [(string) $value] : []);
    @endphp

    <x-site.hero-banner eyebrow="Portal Para Empresas" :title="$plans['title'] ?? 'Planos Empresariais'" :subtitle="$heroSubtitle"
        :primary-button-text="$cta['label'] ?? 'Solicitar diagnóstico empresarial'" :primary-button-url="$ctaPrimaryUrl"
        secondary-button-text="Como trabalhamos" secondary-button-url="/para-empresas/como-trabalhamos" :image="$plans['image'] ?? 'img/sophdata/cta/contact-banner.webp'"
        :image-alt="$plans['image_alt'] ?? ($plans['title'] ?? 'Planos Empresariais SophData')" />

    @if (filled($plans['selection_guide'] ?? []))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Guia de escolha" title="Qual caminho faz mais sentido agora?"
                    description="Use os sinais abaixo para chegar mais rapido ao tipo de plano que combina com a necessidade atual da empresa."
                    centered />
                <ul class="mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-5">
                    @foreach ($plans['selection_guide'] as $guide)
                        <li>
                            <a href="{{ $guide['url'] ?? '/para-empresas/contato' }}"
                                class="group flex h-full flex-col rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm transition hover:-translate-y-1 hover:border-brand-300 hover:bg-white hover:shadow-xl">
                                <p class="text-sm font-semibold leading-6 text-slate-600">{{ $guide['need'] ?? '' }}</p>
                                <h3 class="mt-4 text-xl font-bold text-brand-950">{{ $guide['path'] ?? 'Plano empresarial' }}</h3>
                                <p class="mt-3 flex-1 leading-7 text-slate-600">{{ $guide['description'] ?? '' }}</p>
                                <span class="mt-5 text-sm font-bold text-brand-700">Ver caminho</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @foreach ($groups as $group)
        <section id="{{ $group['slug'] ?? 'grupo-' . $loop->iteration }}"
            class="scroll-mt-48 {{ $loop->even ? 'bg-white' : 'bg-slate-50' }} py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Planos empresariais" :title="$group['title'] ?? 'Grupo de planos'"
                    :description="$group['description'] ?? null" centered />
                <div class="mt-12 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                    @foreach ($group['items'] ?? [] as $item)
                        @php
                            $includedItems = $displayList($item['includes'] ?? $item['limits'] ?? []);
                            $initialPrice = $item['starting_price'] ?? $item['initial_implementation'] ?? null;
                            $monthlyPrice = $item['monthly_price'] ?? $item['monthly_suggestion'] ?? null;
                        @endphp
                        <article class="flex h-full flex-col rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <p class="text-xs font-bold uppercase tracking-[0.16em] text-brand-600">
                                {{ $item['indicated_for'] ?? 'Indicado para empresas' }}
                            </p>
                            <h3 class="mt-3 text-xl font-bold text-brand-950">{{ $item['name'] ?? 'Plano empresarial' }}</h3>
                            @if (filled($includedItems))
                                <ul class="mt-5 grid gap-2 text-sm leading-6 text-slate-600">
                                    @foreach ($includedItems as $includedItem)
                                        <li class="flex gap-2">
                                            <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                            <span>{{ $includedItem }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="mt-6 grid gap-2 text-sm font-semibold text-brand-950">
                                @if (filled($initialPrice))
                                    <p>Implantação: {{ $initialPrice }}</p>
                                @endif
                                @if (filled($monthlyPrice))
                                    <p>Mensalidade: {{ $monthlyPrice }}</p>
                                @endif
                            </div>
                            <a href="{{ $item['url'] ?? $ctaUrl }}"
                                class="mt-6 inline-flex w-fit items-center justify-center rounded-full bg-brand-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-brand-700">
                                Conhecer plano
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach

    <section class="bg-brand-950 py-16 text-white sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-8xl gap-10 px-4 sm:px-6 lg:grid-cols-[1.1fr_0.9fr] lg:px-8">
            @if (filled($plans['not_included'] ?? []))
                <div>
                    <x-site.section-heading eyebrow="Escopo" title="O que normalmente não está incluso"
                        description="Para manter propostas claras, alguns itens dependem de orçamento separado, fornecedor externo ou diagnóstico específico."
                        class="text-white" />
                    <ul class="mt-8 grid gap-3 text-sm leading-6 text-white/80">
                        @foreach ($plans['not_included'] as $item)
                            <li class="flex gap-3">
                                <span class="mt-1 size-2 shrink-0 rounded-full bg-brand-300" aria-hidden="true"></span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (filled($plans['commercial_notes'] ?? []))
                <div class="rounded-3xl border border-white/15 bg-white/10 p-6 shadow-sm">
                    <h2 class="text-2xl font-bold">Observações comerciais</h2>
                    <ul class="mt-6 grid gap-3 text-sm leading-6 text-white/80">
                        @foreach ($plans['commercial_notes'] as $note)
                            <li class="flex gap-3">
                                <span class="font-bold text-brand-300" aria-hidden="true">✓</span>
                                <span>{{ $note }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>

    <x-site.cta-section title="Quer escolher o plano certo para sua empresa?"
        description="Conte o momento atual da operação. A SophData ajuda a organizar o diagnóstico, o escopo e o caminho de contratação mais adequado."
        :button-text="$cta['label'] ?? 'Solicitar diagnóstico empresarial'" :button-url="$ctaPrimaryUrl"
        :image="$plans['image'] ?? 'img/sophdata/portals/business-hero.webp'" :image-alt="$plans['image_alt'] ?? 'Planos empresariais SophData'" />
@endsection
