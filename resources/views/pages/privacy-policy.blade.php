@extends('layouts.site')

@section('title', 'Política de Privacidade | SophData')
@section('meta_description', 'Informações simples sobre privacidade e uso de dados no site institucional da SophData.')

@section('content')
    @php
        $whatsappUrl = sophdata_whatsapp_url('Olá, quero atendimento sobre privacidade e dados pessoais.');
        $sections = [
            ['title' => 'Site institucional', 'text' => 'O site da SophData apresenta informações institucionais, portais comerciais, categorias de serviços e formas de iniciar atendimento.'],
            ['title' => 'Atendimento por link externo', 'text' => 'Quando você clica em um CTA de atendimento, o contato pode ser iniciado em uma plataforma externa de comunicação, sujeita aos próprios termos e políticas.'],
            ['title' => 'Uso dos dados enviados', 'text' => 'Dados enviados voluntariamente por canais de contato são usados apenas para compreender a solicitação, prestar atendimento, elaborar orientação ou orçamento e manter a comunicação relacionada.'],
            ['title' => 'Sem cadastro de usuários', 'text' => 'Nesta fase, o site não possui cadastro de usuários, login ou criação de conta.'],
            ['title' => 'Sem pagamento online', 'text' => 'Nesta fase, o site não processa pagamentos online e não solicita dados de cartão ou meios de pagamento.'],
            ['title' => 'Sem área do cliente', 'text' => 'Nesta fase, o site não possui área do cliente, painel administrativo público ou ambiente de acompanhamento com autenticação.'],
            ['title' => 'Análise de acesso futura', 'text' => 'Futuramente, podem ser usadas ferramentas de análise de acesso para entender navegação, desempenho e interesse nas páginas. Se isso acontecer, esta política poderá ser atualizada.'],
        ];
    @endphp

    <section class="bg-brand-50 py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-600">Privacidade</p>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-brand-950 sm:text-5xl">Política de Privacidade</h1>
            <p class="mt-4 text-slate-600">Texto simples sobre como funciona o contato com a SophData nesta fase institucional.</p>
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
                <h2 class="text-2xl font-bold">Dúvidas sobre privacidade?</h2>
                <p class="mt-3 leading-7 text-brand-100/80">Inicie atendimento para solicitar esclarecimentos sobre dados enviados por contato direto.</p>
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="mt-6 inline-flex min-h-12 items-center rounded-full bg-action-500 px-6 py-3 text-sm font-bold text-white hover:bg-action-600">
                    Solicitar atendimento
                </a>
            </article>
        </div>
    </section>
@endsection
