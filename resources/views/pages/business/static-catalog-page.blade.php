@extends('layouts.site')

@section('title', $title . ' | SophData')
@section('meta_description', $description)

@section('content')
    @php
        $whatsappUrl = sophdata_whatsapp_url($cta['whatsapp_message'] ?? 'Olá! Quero atendimento empresarial com a SophData.');
    @endphp

    <x-site.hero-banner :eyebrow="$eyebrow" :title="$title" :subtitle="$description" :primary-button-text="$cta['primary_label'] ?? $cta['label'] ?? 'Solicitar atendimento'"
        :primary-button-url="$whatsappUrl" secondary-button-text="Voltar para empresas" secondary-button-url="/para-empresas" :image="$image"
        :image-alt="$title" />

    @if (filled($steps))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Processo" title="Etapas de trabalho"
                    description="Estrutura preparada para orientar as proximas páginas do catálogo empresarial." centered />
                <x-site.process-steps :steps="$steps" class="mt-12" />
            </div>
        </section>
    @endif

    @if (filled($items))
        <section class="bg-white py-16 sm:py-20 lg:py-24">
            <div class="mx-auto max-w-8xl px-4 sm:px-6 lg:px-8">
                <x-site.section-heading eyebrow="Planos" title="Grupos de planos configurados"
                    description="Conteúdo provisoriamente carregado da configuração empresarial." centered />
                <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($items as $item)
                        <article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                            <h3 class="text-lg font-bold text-brand-950">{{ $item['title'] ?? $item['name'] ?? 'Plano empresarial' }}</h3>
                                <p class="mt-3 leading-7 text-slate-600">{{ $item['description'] ?? '' }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
