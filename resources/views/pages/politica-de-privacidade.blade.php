@extends('layouts.site')

@section('title', 'Política de Privacidade | SophData')
@section('meta_description', 'Informações sobre privacidade e uso de dados no site institucional da SophData.')

@section('content')
    @php
        $whatsappUrl = sophdata_whatsapp_url('Olá, gostaria de falar sobre privacidade e dados pessoais.');
    @endphp

    <section class="bg-brand-50 py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-600">Privacidade</p>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-brand-950 sm:text-5xl">Política de Privacidade</h1>
            <p class="mt-4 text-slate-600">Última atualização: 15 de junho de 2026.</p>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20">
        <article class="mx-auto max-w-4xl px-4 sm:px-6">
            <div class="rounded-3xl border border-brand-100 bg-brand-50 p-6 text-slate-700 sm:p-8">
                <p class="leading-8">
                    Esta política explica, em linguagem simples, como funciona o contato com a SophData nesta fase institucional do site.
                </p>
            </div>

            <div class="mt-12 space-y-10 text-slate-600">
                <section>
                    <h2 class="text-2xl font-bold text-brand-950">1. Site institucional</h2>
                    <p class="mt-4 leading-8">
                        O site da SophData tem finalidade institucional e comercial. Ele apresenta serviços, categorias e formas de atendimento para pessoas, empresas e instituições.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-brand-950">2. Contato pelo WhatsApp</h2>
                    <p class="mt-4 leading-8">
                        O principal canal de contato é o WhatsApp. Ao clicar nos botões do site, você será direcionado para uma plataforma externa, sujeita aos próprios termos e políticas.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-brand-950">3. Uso dos dados enviados</h2>
                    <p class="mt-4 leading-8">
                        Informações enviadas voluntariamente pelo WhatsApp ou e-mail serão usadas apenas para compreender a solicitação, prestar atendimento, elaborar orçamento e manter a comunicação relacionada ao serviço.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-brand-950">4. Cadastro e pagamento</h2>
                    <p class="mt-4 leading-8">
                        Nesta fase, o site não possui cadastro de usuários, área de login ou pagamento online. Também não existe formulário funcional conectado a banco de dados.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-brand-950">5. Análise de acesso</h2>
                    <p class="mt-4 leading-8">
                        O site poderá futuramente utilizar ferramentas de análise de acesso para entender navegação, desempenho e interesse nas páginas. Caso isso aconteça, esta política poderá ser atualizada.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-brand-950">6. Remoção de dados</h2>
                    <p class="mt-4 leading-8">
                        Você pode solicitar esclarecimentos, correção ou remoção de dados enviados por contato direto, usando o WhatsApp ou o e-mail
                        <a href="mailto:{{ config('sophdata.brand.email') }}" class="font-semibold text-brand-600 underline decoration-brand-200 underline-offset-4 hover:text-brand-800">{{ config('sophdata.brand.email') }}</a>.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-bold text-brand-950">7. Atualizações desta política</h2>
                    <p class="mt-4 leading-8">
                        Este texto poderá ser revisado quando novos recursos, integrações ou práticas de tratamento de dados forem implementados.
                    </p>
                </section>
            </div>

            <div class="mt-12 flex flex-col items-start gap-4 rounded-3xl bg-brand-950 p-7 text-white sm:p-8">
                <h2 class="text-2xl font-bold">Dúvidas sobre privacidade?</h2>
                <p class="leading-7 text-brand-100/75">Entre em contato diretamente com a SophData.</p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-12 items-center rounded-full bg-action-500 px-6 py-3 text-sm font-bold text-white hover:bg-action-600">
                    Falar pelo WhatsApp
                </a>
            </div>
        </article>
    </section>
@endsection
