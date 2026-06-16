@extends('layouts.site')

@section('title', 'Política de Privacidade | SophData')
@section('meta_description', 'Política de privacidade do site institucional da SophData, com informações sobre contato, atendimento e uso de dados.')

@section('content')
    @php
        $whatsappUrl = sophdata_whatsapp_url('Olá, quero atendimento sobre privacidade e dados pessoais.');
        $sections = [
            ['title' => 'Site institucional', 'text' => 'A SophData utiliza este site para apresentar serviços de tecnologia, organizar informações comerciais e facilitar o início do atendimento.'],
            ['title' => 'Início de atendimento', 'text' => 'O contato pode ser iniciado por links externos de atendimento, como aplicativos de mensagem ou e-mail. Ao enviar uma mensagem, o visitante compartilha voluntariamente as informações necessárias para análise da solicitação.'],
            ['title' => 'Uso das informações', 'text' => 'As informações enviadas pelo cliente são utilizadas apenas para compreender a necessidade, orientar o atendimento, elaborar proposta ou dar continuidade ao serviço solicitado.'],
            ['title' => 'Dados que podem ser informados pelo cliente', 'text' => 'Durante o atendimento, o cliente pode informar nome, telefone, e-mail, tipo de necessidade, contexto do problema, informações sobre equipamentos, sistemas, arquivos, rede ou serviços desejados.'],
            ['title' => 'O que o site não possui nesta fase', 'text' => 'Nesta fase, o site não possui: cadastro de usuários; área do cliente; login; pagamento online; sistema de chamados; formulário funcional com armazenamento de dados; banco de dados para registrar solicitações.'],
            ['title' => 'Ferramentas futuras', 'text' => 'No futuro, o site poderá utilizar ferramentas de análise de acesso, formulário de contato, blog, área administrativa ou sistema de chamados. Caso isso aconteça, esta política poderá ser atualizada.'],
            ['title' => 'Segurança e responsabilidade', 'text' => 'A SophData busca tratar informações de atendimento com responsabilidade, clareza e finalidade limitada ao serviço solicitado.'],
            ['title' => 'Solicitação de remoção ou correção', 'text' => 'O cliente pode solicitar correção ou remoção de informações enviadas durante o atendimento, quando aplicável.'],
            ['title' => 'Contato', 'text' => 'Dúvidas sobre esta política podem ser tratadas pelos canais de atendimento informados no site.'],
        ];
    @endphp

    <section class="bg-brand-50 py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-600">Privacidade</p>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-brand-950 sm:text-5xl">Política de Privacidade</h1>
            <p class="mt-4 text-slate-600">Esta página explica, de forma simples, como as informações de contato são tratadas no site institucional da SophData.</p>
        </div>
    </section>

    <section class="bg-white py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <div class="space-y-6">
                @foreach ($sections as $section)
                    <article class="rounded-3xl border border-slate-200 bg-slate-50 p-6 sm:p-8">
                        <h2 class="text-2xl font-bold text-brand-950">{{ $loop->iteration }}. {{ $section['title'] }}</h2>
                        <p class="mt-4 leading-8 text-slate-600">{{ $section['text'] }}</p>
                    </article>
                @endforeach
            </div>

            <article class="mt-10 rounded-3xl bg-brand-950 p-7 text-white sm:p-8">
                <h2 class="text-2xl font-bold">Precisa iniciar um atendimento?</h2>
                <p class="mt-3 leading-7 text-brand-100/80">Entre em contato e informe sua necessidade de forma simples e objetiva.</p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex min-h-12 items-center rounded-full bg-action-500 px-6 py-3 text-sm font-bold text-white hover:bg-action-600">
                    Iniciar atendimento
                </a>
            </article>
        </div>
    </section>
@endsection
