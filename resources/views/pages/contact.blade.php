@extends('layouts.site')

@section('title', 'Contato | SophData')
@section('meta_description', 'Inicie atendimento e receba orientação sobre soluções de tecnologia da SophData.')

@section('content')
    @php
        $whatsappMessage =
            'Olá! Quero iniciar atendimento com a SophData. Meu atendimento é para: [pessoa física/empresa]. Preciso resolver: [descreva]. Urgência: [sim/não]. Pode ser remoto: [sim/não]. Pacote de interesse: [se houver].';
        $whatsappUrl = sophdata_whatsapp_url($whatsappMessage);
        $businessWhatsappUrl = sophdata_whatsapp_url('Olá, quero solicitar atendimento empresarial com a SophData.');
        $personalWhatsappUrl = sophdata_whatsapp_url('Olá, quero atendimento para uma necessidade pessoal.');
        $questions = [
            'O atendimento é para pessoa física ou empresa?',
            'Qual problema deseja resolver?',
            'O atendimento é urgente?',
            'Pode ser remoto?',
            'Existe algum pacote de interesse?',
        ];
    @endphp

    <x-site.hero-banner eyebrow="Contato" title="Inicie seu atendimento"
        subtitle="Conte rapidamente o que você precisa resolver. A SophData orienta você na escolha do serviço ou pacote mais adequado."
        primary-button-text="Iniciar atendimento" :primary-button-url="$whatsappUrl" secondary-button-text="Solicitar atendimento empresarial"
        :secondary-button-url="$businessWhatsappUrl" tertiary-button-text="Quero atendimento" :tertiary-button-url="$personalWhatsappUrl"
        :image="config('sophdata.images.contact')" image-alt="Atendimento de tecnologia da SophData" />

    <section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-8xl gap-6 px-4 sm:px-6 lg:grid-cols-4 lg:px-8">
            <article class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
                <h2 class="text-2xl font-bold text-brand-950">Atendimento</h2>
                <p class="mt-3 leading-7 text-slate-600">Canal principal para explicar sua necessidade e solicitar
                    orientação.</p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                    class="mt-7 inline-flex min-h-12 items-center rounded-full bg-action-500 px-5 py-3 text-sm font-bold text-white hover:bg-action-600">
                    Iniciar atendimento
                </a>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
                <h2 class="text-2xl font-bold text-brand-950">E-mail</h2>
                <p class="mt-3 leading-7 text-slate-600">Para contatos institucionais e informações que precisem ficar
                    registradas.</p>
                <a href="mailto:{{ config('sophdata.brand.email') }}"
                    class="mt-7 block break-all font-bold text-brand-600 hover:text-brand-800">
                    {{ config('sophdata.brand.email') }}
                </a>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
                <h2 class="text-2xl font-bold text-brand-950">Região</h2>
                <p class="mt-3 leading-7 text-slate-600">{{ config('sophdata.brand.region') }}.</p>
                <p class="mt-5 text-sm font-bold text-brand-600">Atendimento presencial sob consulta.</p>
            </article>
            <article class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
                <h2 class="text-2xl font-bold text-brand-950">Modalidade</h2>
                <p class="mt-3 leading-7 text-slate-600">Atendimento remoto para muitas demandas e presencial quando
                    combinado.</p>
                <p class="mt-5 text-sm font-bold text-brand-600">Remoto e presencial sob consulta.</p>
            </article>
        </div>
    </section>

    <section id="roteiro" class="scroll-mt-48 bg-white py-16 sm:py-20 lg:py-24">
        <div class="mx-auto grid max-w-8xl items-start gap-12 px-4 sm:px-6 lg:grid-cols-[.9fr_1.1fr] lg:px-8">
            <div>
                <x-site.section-heading eyebrow="Antes de iniciar" title="Perguntas para orientar o atendimento"
                    description="Não é um formulário funcional. Use este roteiro visual para preparar sua mensagem antes de iniciar o atendimento." />
                <div class="mt-8 rounded-3xl bg-brand-50 p-6 ring-1 ring-brand-100">
                    <p class="font-bold text-brand-950">Como funciona?</p>
                    <p class="mt-2 leading-7 text-slate-600">O link abre um canal externo de contato com uma mensagem-base.
                        Complete apenas o que fizer sentido para sua solicitação.</p>
                </div>
            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6 shadow-sm sm:p-8">
                <h3 class="text-sm font-bold uppercase tracking-[0.16em] text-brand-600">Roteiro visual</h3>
                <div class="mt-6 grid gap-4">
                    @foreach ($questions as $question)
                        <article class="flex gap-4 rounded-2xl border border-slate-200 bg-white p-5">
                            <span
                                class="grid size-9 shrink-0 place-items-center rounded-full bg-brand-100 text-sm font-bold text-brand-700">{{ $loop->iteration }}</span>
                            <p class="font-semibold leading-7 text-brand-950">{{ $question }}</p>
                        </article>
                    @endforeach
                </div>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer"
                    class="mt-7 inline-flex min-h-12 w-full items-center justify-center rounded-full bg-action-500 px-6 py-3 text-center text-sm font-bold text-white hover:bg-action-600">
                    Solicitar atendimento
                </a>
            </div>
        </div>
    </section>

    <p class="bg-brand-50 px-4 py-8 text-center text-sm text-slate-600">
        Este site não possui formulário funcional, cadastro ou armazenamento das respostas acima.
    </p>
@endsection
