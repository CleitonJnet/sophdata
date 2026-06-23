@extends('layouts.site')

@section('title', $page['seo']['title'] ?? 'Solicitar atendimento pessoal | Atendimento Técnico SophData')
@section('meta_description', $page['seo']['description'] ?? ($page['description'] ?? 'Solicitar atendimento pessoal SophData.'))

@section('content')
    @php
        $primaryCta = $page['primary_cta'] ?? [];
        $secondaryCta = $page['secondary_cta'] ?? [];
        $primaryUrl = filled($primaryCta['whatsapp_message'] ?? null)
            ? (sophdata_whatsapp_url($primaryCta['whatsapp_message']) ?: ($primaryCta['url'] ?? '/para-voce'))
            : ($primaryCta['url'] ?? '/para-voce');
        $heroSubtitle = trim(implode(' ', array_filter([
            $page['subtitle'] ?? null,
            $page['description'] ?? null,
        ])));
        $businessRedirect = $page['business_redirect'] ?? [];
        $finalCta = $page['final_cta'] ?? [];
        $finalCtaUrl = filled($finalCta['whatsapp_message'] ?? null)
            ? sophdata_whatsapp_url($finalCta['whatsapp_message'])
            : null;
    @endphp

    <x-site.hero-banner eyebrow="Portal Para Você" :title="$page['title'] ?? 'Solicitar atendimento pessoal'" :subtitle="$heroSubtitle"
        :primary-button-text="$primaryCta['label'] ?? 'Iniciar atendimento pessoal'" :primary-button-url="$primaryUrl"
        :secondary-button-text="$secondaryCta['label'] ?? 'Ver serviços Para Você'" :secondary-button-url="$secondaryCta['url'] ?? '/para-voce'"
        :image="$page['image'] ?? 'img/sophdata/cta/contact-banner.webp'" :image-alt="$page['image_alt'] ?? 'Atendimento técnico da SophData para pessoa física'" />

    @if (filled($page['needs'] ?? []))
        <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Necessidades pessoais" title="Sobre o que você precisa de ajuda?"
                    description="Escolha o assunto mais próximo do problema para facilitar o primeiro atendimento."
                    centered />
                <ul class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @foreach ($page['needs'] as $need)
                        @php
                            $needUrl = filled($need['whatsapp_message'] ?? null)
                                ? sophdata_whatsapp_url($need['whatsapp_message'])
                                : null;
                        @endphp
                        <li class="flex h-full flex-col rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h2 class="text-xl font-bold text-brand-950">{{ $need['title'] }}</h2>
                            <p class="mt-3 flex-1 leading-7 text-slate-600">{{ $need['description'] }}</p>
                            @if ($needUrl)
                                <a href="{{ $needUrl }}" target="_blank" rel="noopener noreferrer"
                                    class="mt-6 inline-flex min-h-11 items-center justify-center rounded-full bg-action-500 px-5 py-3 text-center text-sm font-bold text-white shadow-sm transition hover:bg-action-600">
                                    Chamar sobre isso
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <section class="bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-8xl gap-10 px-4 sm:px-6 lg:grid-cols-[0.95fr_1.05fr] lg:px-8">
            @if (filled($page['first_contact_checklist'] ?? []))
                <div>
                    <x-site.section-heading eyebrow="Primeiro contato" title="O que enviar no primeiro contato"
                        description="Algumas informações ajudam a entender melhor o problema e agilizar o atendimento." />
                    <ul class="mt-8 grid gap-3 text-sm leading-6 text-slate-600">
                        @foreach ($page['first_contact_checklist'] as $item)
                            <li class="flex gap-3">
                                <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                <span>{{ $item }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (filled($page['initial_flow'] ?? []))
                <div>
                    <x-site.section-heading eyebrow="Atendimento inicial" title="Como funciona o atendimento inicial"
                        description="O primeiro contato serve para entender o problema e indicar o melhor caminho." />
                    <x-site.process-steps :steps="$page['initial_flow']" class="mt-8 md:grid-cols-2" />
                </div>
            @endif
        </div>
    </section>

    @if (filled($page['commercial_notes'] ?? []))
        <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Orientações pessoais" title="Orientações importantes"
                    description="Alguns cuidados deixam o atendimento mais claro e ajudam a proteger seus dados."
                    centered />
                <ul class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($page['commercial_notes'] as $note)
                        <li class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <p class="font-semibold leading-7 text-brand-950">{{ $note }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if (filled($businessRedirect))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-5xl px-4 text-center sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Perfil correto" :title="$businessRedirect['title'] ?? 'Atendimento para empresa?'"
                    :description="$businessRedirect['description'] ?? null" centered />
                <a href="{{ $businessRedirect['url'] ?? '/para-empresas/contato' }}"
                    class="mt-8 inline-flex min-h-12 items-center justify-center rounded-full border border-brand-200 px-6 py-3 text-sm font-bold text-brand-700 transition hover:border-brand-400 hover:bg-brand-50">
                    {{ $businessRedirect['label'] ?? 'Ir para contato empresarial' }}
                </a>
            </div>
        </section>
    @endif

    <x-site.cta-section :title="$finalCta['title'] ?? 'Quer atendimento técnico pessoal?'" :description="$finalCta['description'] ?? 'Envie uma mensagem contando o problema. A SophData orienta o melhor caminho para suporte remoto ou presencial, quando aplicável.'"
        :button-text="$finalCta['label'] ?? 'Iniciar atendimento pessoal'" :button-url="$finalCtaUrl ?: $primaryUrl"
        :secondary-button-text="$secondaryCta['label'] ?? 'Ver serviços Para Você'" :secondary-button-url="$secondaryCta['url'] ?? '/para-voce'"
        :image="$finalCta['image'] ?? ($page['image'] ?? 'img/sophdata/cta/contact-banner.webp')" :image-alt="$page['image_alt'] ?? 'Atendimento técnico da SophData para pessoa física'" />
@endsection
