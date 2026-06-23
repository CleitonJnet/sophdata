@extends('layouts.site')

@section('title', ($page['title'] ?? 'Como Trabalhamos') . ' | SophData')
@section('meta_description', $page['description'] ?? 'Método de trabalho empresarial SophData.')

@section('content')
    @php
        $cta = $page['cta'] ?? [];
        $ctaUrl = $cta['url'] ?? '/para-empresas/contato';
        $ctaPrimaryUrl = filled($cta['whatsapp_message'] ?? null)
            ? (sophdata_whatsapp_url($cta['whatsapp_message']) ?: $ctaUrl)
            : $ctaUrl;
        $heroSubtitle = trim(implode(' ', array_filter([
            $page['subtitle'] ?? null,
            $page['description'] ?? null,
        ])));
    @endphp

    <x-site.hero-banner eyebrow="Portal Para Empresas" :title="$page['title'] ?? 'Como Trabalhamos'" :subtitle="$heroSubtitle"
        :primary-button-text="$cta['label'] ?? 'Solicitar diagnóstico empresarial'" :primary-button-url="$ctaPrimaryUrl"
        secondary-button-text="Ver planos empresariais" secondary-button-url="/para-empresas/planos" :image="$page['image'] ?? 'img/sophdata/cta/contact-banner.webp'"
        :image-alt="$page['image_alt'] ?? ($page['title'] ?? 'Como Trabalhamos SophData')" />

    @if (filled($page['diagnosis'] ?? []))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Diagnóstico" :title="$page['diagnosis']['title']"
                    :description="$page['diagnosis']['description']" centered />
                <ul class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($page['diagnosis']['points'] ?? [] as $point)
                        <li class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
                            <span class="grid size-10 place-items-center rounded-full bg-brand-100 font-bold text-brand-700" aria-hidden="true">✓</span>
                            <p class="mt-5 font-semibold leading-7 text-brand-950">{{ $point }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if (filled($page['steps'] ?? []))
        <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Método" title="Nosso método em etapas"
                    description="Cada etapa existe para evitar improviso, reduzir risco e manter clareza entre a SophData e a empresa atendida."
                    centered />
                <x-site.process-steps :steps="$page['steps']" class="mt-12 lg:grid-cols-4" />
            </div>
        </section>
    @endif

    @if (filled($page['service_paths'] ?? []))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Tipos de serviço" title="O método se adapta ao tipo de solução"
                    description="Software, infraestrutura e servidores exigem cuidados diferentes, mas todos precisam de diagnóstico, escopo e acompanhamento."
                    centered />
                <div class="mt-12 grid gap-6 lg:grid-cols-3">
                    @foreach ($page['service_paths'] as $path)
                        <article class="flex h-full flex-col rounded-3xl border border-slate-200 bg-slate-50 p-7 shadow-sm">
                            <h3 class="text-2xl font-bold text-brand-950">{{ $path['title'] }}</h3>
                            <p class="mt-4 flex-1 leading-7 text-slate-600">{{ $path['description'] }}</p>
                            <ul class="mt-6 grid gap-2 text-sm leading-6 text-slate-600">
                                @foreach ($path['steps'] ?? [] as $step)
                                    <li class="flex gap-2">
                                        <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                        <span>{{ $step }}</span>
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ $path['url'] }}"
                                class="mt-6 inline-flex w-fit items-center justify-center rounded-full bg-brand-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-brand-700">
                                Conhecer caminho
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (filled($page['contracting_models'] ?? []))
        <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Contratação" title="Formas de contratação"
                    description="A contratação pode ser pontual, por projeto ou mensal, conforme a necessidade e maturidade da empresa."
                    centered />
                <ul class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
                    @foreach ($page['contracting_models'] as $model)
                        <li class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-xl font-bold text-brand-950">{{ $model['title'] }}</h3>
                            <p class="mt-3 leading-7 text-slate-600">{{ $model['description'] }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-8xl gap-10 px-4 sm:px-6 lg:grid-cols-2 lg:px-8">
            @if (filled($page['scope_rules'] ?? []))
                <div>
                    <x-site.section-heading eyebrow="Escopo" title="Escopo claro evita surpresa"
                        description="Antes de iniciar, buscamos alinhar o que será feito, o que não está incluso, prazos, responsabilidades e critérios de aceite." />
                    <ul class="mt-8 grid gap-3 text-sm leading-6 text-slate-600">
                        @foreach ($page['scope_rules'] as $rule)
                            <li class="flex gap-3">
                                <span class="mt-1 size-2 shrink-0 rounded-full bg-brand-600" aria-hidden="true"></span>
                                <span>{{ $rule }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (filled($page['documentation'] ?? []))
                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-7 shadow-sm">
                    <h2 class="text-3xl font-bold tracking-tight text-brand-950">{{ $page['documentation']['title'] }}</h2>
                    <p class="mt-4 text-lg leading-8 text-slate-600">{{ $page['documentation']['description'] }}</p>
                    <ul class="mt-8 grid gap-3 text-sm leading-6 text-slate-600">
                        @foreach ($page['documentation']['points'] ?? [] as $point)
                            <li class="flex gap-3">
                                <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                <span>{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </section>

    @if (filled($page['client_responsibilities'] ?? []))
        <section class="bg-brand-950 py-16 text-white sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <div class="max-w-2xl">
                    <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-300">Responsabilidades</p>
                    <h2 class="mt-3 text-3xl font-bold tracking-tight sm:text-4xl">O que precisamos da empresa atendida</h2>
                    <p class="mt-4 text-lg leading-8 text-white/75">
                        Uma boa entrega depende também de informações, decisões e validações do cliente durante o processo.
                    </p>
                </div>
                <ul class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($page['client_responsibilities'] as $responsibility)
                        <li class="rounded-3xl border border-white/15 bg-white/10 p-6 shadow-sm">
                            <p class="font-semibold leading-7 text-white">{{ $responsibility }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <x-site.cta-section title="Quer começar com um diagnóstico?"
        description="Conte o cenário atual da sua empresa. A SophData ajuda a identificar o melhor caminho entre software, infraestrutura, servidores, suporte mensal e evolução."
        :button-text="$cta['label'] ?? 'Solicitar diagnóstico empresarial'" :button-url="$ctaPrimaryUrl"
        :image="$page['image'] ?? 'img/sophdata/portals/business-hero.webp'" :image-alt="$page['image_alt'] ?? 'Diagnóstico empresarial SophData'" />
@endsection
