@extends('layouts.site')

@section('title', 'Contato | SophData')
@section('meta_description', 'Fale com a SophData pelo WhatsApp e solicite atendimento ou orçamento para soluções em TI.')

@section('content')
    @php
        $whatsappMessage = 'Olá! Quero orientação da SophData. Meu atendimento é para: [pessoa física/empresa]. Preciso resolver: [descreva]. Urgência: [sim/não]. Pode ser remoto: [sim/não]. Pacote de interesse: [se houver].';
        $whatsappUrl = sophdata_whatsapp_url($whatsappMessage);
        $questions = [
            'Você precisa de atendimento para pessoa física ou empresa?',
            'Qual problema deseja resolver?',
            'É algo urgente?',
            'O atendimento pode ser remoto?',
            'Você precisa de orçamento para algum pacote específico?',
        ];
    @endphp

    <x-site.hero-banner
        eyebrow="Contato"
        title="Fale com a SophData"
        subtitle="Explique sua necessidade e receba orientação sobre o pacote mais adequado."
        primary-button-text="Conversar no WhatsApp"
        :primary-button-url="$whatsappUrl"
        secondary-button-text="Como se preparar"
        secondary-button-url="#roteiro"
        image="https://placehold.co/720x520/0B1F4D/FFFFFF?text=Contato+SophData"
    />

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:grid-cols-3 lg:px-8">
            <h2 class="sr-only">Canais de atendimento</h2>
            <article class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
                <span class="grid size-12 place-items-center rounded-2xl bg-brand-100 text-brand-700">
                    <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M20 11.5a8 8 0 0 1-11.8 7L4 20l1.5-4A8 8 0 1 1 20 11.5Z"/>
                    </svg>
                </span>
                <h3 class="mt-6 text-2xl font-bold text-brand-950">WhatsApp</h3>
                <p class="mt-3 leading-7 text-slate-600">Canal principal para explicar sua necessidade e solicitar orientação.</p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="mt-7 inline-flex min-h-12 items-center rounded-full bg-action-500 px-5 py-3 text-sm font-bold text-white hover:bg-action-600">
                    Iniciar atendimento
                </a>
            </article>

            <article class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
                <span class="grid size-12 place-items-center rounded-2xl bg-brand-100 text-brand-700">
                    <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M4 5h16v14H4z"/><path d="m4 7 8 6 8-6"/>
                    </svg>
                </span>
                <h3 class="mt-6 text-2xl font-bold text-brand-950">E-mail</h3>
                <p class="mt-3 leading-7 text-slate-600">Para contatos institucionais e informações que precisem ficar registradas.</p>
                <a href="mailto:{{ config('sophdata.brand.email') }}" class="mt-7 block break-all font-bold text-brand-600 hover:text-brand-800">
                    {{ config('sophdata.brand.email') }}
                </a>
            </article>

            <article class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
                <span class="grid size-12 place-items-center rounded-2xl bg-brand-100 text-brand-700">
                    <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                        <path d="M12 21s7-5.2 7-12a7 7 0 1 0-14 0c0 6.8 7 12 7 12Z"/><circle cx="12" cy="9" r="2.5"/>
                    </svg>
                </span>
                <h3 class="mt-6 text-2xl font-bold text-brand-950">Região</h3>
                <p class="mt-3 leading-7 text-slate-600">{{ config('sophdata.brand.region') }}.</p>
                <p class="mt-5 text-sm font-bold text-brand-600">Atendimento presencial sob consulta.</p>
            </article>
        </div>
    </section>

    <section id="roteiro" class="scroll-mt-48 bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-7xl items-start gap-12 px-4 sm:px-6 lg:grid-cols-[.9fr_1.1fr] lg:px-8">
            <div>
                <x-site.section-heading
                    eyebrow="Antes de chamar"
                    title="Estas respostas ajudam no diagnóstico inicial"
                    description="Não é um formulário e nenhuma informação é enviada por esta página. Use o roteiro para preparar sua mensagem."
                />
                <div class="mt-8 rounded-3xl bg-brand-50 p-6 ring-1 ring-brand-100">
                    <p class="font-bold text-brand-950">Como funciona?</p>
                    <p class="mt-2 leading-7 text-slate-600">Ao clicar no botão, o WhatsApp abre com uma mensagem-base. Complete os campos e envie somente o que considerar necessário.</p>
                </div>
            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm sm:p-8">
                <h3 class="text-sm font-bold uppercase tracking-[0.16em] text-brand-600">Roteiro visual</h3>
                <div class="mt-6 grid gap-4">
                    @foreach ($questions as $question)
                        <div class="flex gap-4 rounded-2xl border border-slate-200 bg-white p-5">
                            <span class="grid size-9 shrink-0 place-items-center rounded-full bg-brand-100 text-sm font-bold text-brand-700">{{ $loop->iteration }}</span>
                            <p class="font-semibold leading-7 text-brand-950">{{ $question }}</p>
                        </div>
                    @endforeach
                </div>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="mt-7 inline-flex min-h-12 w-full items-center justify-center rounded-full bg-action-500 px-6 py-3 text-center text-sm font-bold text-white hover:bg-action-600">
                    Responder pelo WhatsApp
                </a>
            </div>
        </div>
    </section>

    <p class="bg-brand-50 px-4 py-8 text-center text-sm text-slate-600">
        Este site não possui formulário funcional, cadastro ou armazenamento das respostas acima.
    </p>
@endsection
