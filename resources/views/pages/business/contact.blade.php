@extends('layouts.site')

@section('title', ($page['title'] ?? 'Contato Empresarial') . ' | SophData')
@section('meta_description', $page['description'] ?? 'Contato empresarial SophData.')

@section('content')
    @php
        $primaryCta = $page['primary_cta'] ?? [];
        $secondaryCta = $page['secondary_cta'] ?? [];
        $primaryUrl = filled($primaryCta['whatsapp_message'] ?? null)
            ? (sophdata_whatsapp_url($primaryCta['whatsapp_message']) ?: ($primaryCta['url'] ?? '/para-empresas/contato'))
            : ($primaryCta['url'] ?? '/para-empresas/contato');
        $heroSubtitle = trim(implode(' ', array_filter([
            $page['subtitle'] ?? null,
            $page['description'] ?? null,
        ])));
        $channels = collect($page['contact_channels'] ?? [])
            ->filter(fn (array $channel): bool => filled($channel['value'] ?? null))
            ->values();
    @endphp

    <x-site.hero-banner eyebrow="Portal Para Empresas" :title="$page['title'] ?? 'Contato Empresarial'" :subtitle="$heroSubtitle"
        :primary-button-text="$primaryCta['label'] ?? 'Chamar no WhatsApp'" :primary-button-url="$primaryUrl"
        :secondary-button-text="$secondaryCta['label'] ?? 'Ver planos empresariais'" :secondary-button-url="$secondaryCta['url'] ?? '/para-empresas/planos'"
        :image="$page['image'] ?? 'img/sophdata/cta/contact-banner.webp'" :image-alt="$page['image_alt'] ?? ($page['title'] ?? 'Contato Empresarial SophData')" />

    @if ($channels->isNotEmpty())
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Canais de contato" title="Escolha o melhor canal para falar com a SophData"
                    description="Para agilizar o atendimento, envie um resumo do cenário da empresa e da necessidade principal."
                    centered />
                <ul class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($channels as $channel)
                        @php
                            $channelUrl = match ($channel['type'] ?? null) {
                                'whatsapp' => sophdata_whatsapp_url($channel['message'] ?? 'Olá! Quero atendimento empresarial com a SophData.', $channel['value'] ?? null),
                                'email' => 'mailto:' . ($channel['value'] ?? ''),
                                default => $channel['url'] ?? '#',
                            };
                            $channelUrl = $channelUrl ?: ($channel['url'] ?? null);
                            $isExternal = $channelUrl && str_starts_with($channelUrl, 'https://wa.me/');
                        @endphp
                        <li class="rounded-3xl border border-slate-200 bg-slate-50 p-7 shadow-sm">
                            <h3 class="text-2xl font-bold text-brand-950">{{ $channel['title'] }}</h3>
                            <p class="mt-4 leading-7 text-slate-600">{{ $channel['description'] }}</p>
                            @if ($channelUrl)
                            <a href="{{ $channelUrl }}" @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif
                                class="mt-6 inline-flex min-h-12 items-center justify-center rounded-full bg-brand-600 px-5 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-brand-700">
                                {{ $channel['label'] ?? 'Iniciar contato' }}
                            </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    @if (filled($page['needs'] ?? []))
        <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Necessidade" title="Sobre o que voce quer falar?"
                    description="Escolha o assunto mais proximo da necessidade da sua empresa." centered />
                <ul class="mt-12 grid gap-6 md:grid-cols-2 xl:grid-cols-5">
                    @foreach ($page['needs'] as $need)
                        @php
                            $needWhatsappUrl = filled($need['whatsapp_message'] ?? null)
                                ? sophdata_whatsapp_url($need['whatsapp_message'])
                                : null;
                        @endphp
                        <li class="flex h-full flex-col rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-xl font-bold text-brand-950">{{ $need['title'] }}</h3>
                            <p class="mt-3 flex-1 leading-7 text-slate-600">{{ $need['description'] }}</p>
                            <div class="mt-6 flex flex-col gap-3">
                                <a href="{{ $need['url'] }}"
                                    class="inline-flex min-h-11 items-center justify-center rounded-full border border-brand-200 px-5 py-3 text-center text-sm font-bold text-brand-700 transition hover:border-brand-400 hover:bg-brand-50">
                                    Conhecer área
                                </a>
                                @if ($needWhatsappUrl)
                                    <a href="{{ $needWhatsappUrl }}" target="_blank" rel="noopener noreferrer"
                                        class="inline-flex min-h-11 items-center justify-center rounded-full bg-action-500 px-5 py-3 text-center text-sm font-bold text-white shadow-sm transition hover:bg-action-600">
                                        Chamar sobre isso
                                    </a>
                                @endif
                            </div>
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
                        description="Quanto mais claro for o cenário inicial, melhor sera a orientação da SophData." />
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
                        description="O primeiro contato serve para entender o cenário, orientar o melhor caminho e evitar propostas feitas no escuro." />
                    <x-site.process-steps :steps="$page['initial_flow']" class="mt-8 md:grid-cols-2" />
                </div>
            @endif
        </div>
    </section>

    @if (filled($page['commercial_notes'] ?? []))
        <section class="bg-brand-50 py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Orientações comerciais" title="Orientações importantes"
                    description="Alguns combinados ajudam a manter a conversa objetiva, profissional e bem direcionada."
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

    @if (filled($empresa['authority'] ?? []))
        <x-site.authority-section :authority="$empresa['authority']" compact />
    @endif

    <x-site.cta-section title="Pronto para organizar a tecnologia da sua empresa?"
        description="Envie uma mensagem contando o cenário atual. A SophData ajuda a identificar o melhor caminho entre software, infraestrutura, servidores e suporte mensal."
        :button-text="$primaryCta['label'] ?? 'Solicitar diagnóstico empresarial'" :button-url="$primaryUrl"
        :image="$page['image'] ?? 'img/sophdata/cta/contact-banner.webp'" :image-alt="$page['image_alt'] ?? 'Contato empresarial SophData'" />
@endsection
