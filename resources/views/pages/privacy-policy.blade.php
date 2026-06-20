@extends('layouts.site')

@section('title', 'Política de Privacidade | SophData')
@section('meta_description', 'Política de privacidade do site institucional da SophData, com informações sobre contato, atendimento e uso de dados.')

@section('content')
    @php
        $whatsappUrl = sophdata_whatsapp_url(config('sophdata.whatsapp_messages.neutral')) ?: route('portal.choose');
        $isWhatsappExternal = str_starts_with($whatsappUrl, 'https://wa.me/');
        $sections = [
            [
                'title' => 'Visão geral',
                'text' => 'A SophData utiliza este site para apresentar serviços de tecnologia, orientar pessoas e empresas e facilitar o início do atendimento. Nesta fase, o site é institucional: não possui banco de dados próprio para registrar solicitações, login, área do cliente, painel administrativo, formulário funcional ou sistema de chamados.',
            ],
            [
                'title' => 'Dados que podem ser tratados na fase atual',
                'text' => 'Quando o visitante inicia contato por canais externos, como aplicativo de mensagem ou e-mail, pode informar voluntariamente nome, telefone, e-mail, perfil de atendimento, necessidade, serviço de interesse, mensagem enviada e contexto do problema. Essas informações são tratadas no próprio canal usado para atendimento.',
            ],
            [
                'title' => 'Dados que poderão ser coletados em fase futura',
                'text' => 'Em uma fase futura, a SophData poderá implementar formulário funcional, sistema gestor ou área de organização comercial. Nesse cenário, poderão ser coletados nome, telefone, e-mail, tipo de perfil, empresa ou instituição quando aplicável, serviço de interesse, mensagem enviada, histórico de atendimento, proposta e contrato, se houver.',
            ],
            [
                'title' => 'Finalidades do tratamento',
                'text' => 'Os dados poderão ser usados para responder solicitações, organizar atendimentos, enviar propostas, registrar relacionamento comercial, separar interessados de clientes e acompanhar contratos ou serviços pontuais. Em fase futura, a SophData poderá usar sistema interno para organizar leads, oportunidades, clientes, propostas, contratos, atendimentos e histórico de interações.',
            ],
            [
                'title' => 'Atendimento por canais externos',
                'text' => 'Os botões de atendimento podem direcionar para canais externos. Ao usar esses canais, o visitante também fica sujeito às regras e políticas das plataformas utilizadas. A SophData recomenda enviar apenas as informações necessárias para iniciar a análise da solicitação.',
            ],
            [
                'title' => 'Armazenamento e segurança',
                'text' => 'A SophData busca tratar informações com responsabilidade, clareza e finalidade limitada ao atendimento solicitado. Medidas de organização e segurança podem ser adotadas conforme a ferramenta utilizada, sem promessa absoluta de segurança. Quando houver sistema próprio, os cuidados de armazenamento poderão ser detalhados nesta política.',
            ],
            [
                'title' => 'Compartilhamento de dados',
                'text' => 'As informações não são vendidas. O compartilhamento poderá ocorrer quando necessário para executar o atendimento, cumprir obrigação legal, usar ferramenta de comunicação, hospedagem, análise ou gestão, ou quando o próprio cliente solicitar continuidade por outro canal.',
            ],
            [
                'title' => 'Direitos do titular',
                'text' => 'O titular pode solicitar acesso, correção, atualização ou remoção de informações enviadas durante o atendimento, quando aplicável. Também pode pedir esclarecimentos sobre o uso dos dados e sobre os canais pelos quais as informações foram recebidas.',
            ],
            [
                'title' => 'Cookies e ferramentas de análise',
                'text' => 'Nesta fase, o site pode usar recursos técnicos necessários ao funcionamento da navegação. Em fase futura, poderá utilizar cookies ou ferramentas de análise de acesso para entender visitas e melhorar a experiência. Caso isso ocorra de forma relevante, esta política poderá ser atualizada.',
            ],
            [
                'title' => 'Atualizações desta política',
                'text' => 'Esta política poderá ser atualizada quando o site evoluir, especialmente se forem implementados formulário funcional, captação de leads, sistema gestor, área administrativa, área do cliente, proposta digital, contrato ou sistema de chamados. Quando houver formulário funcional, o usuário deverá ser avisado antes do envio, e poderá haver campo de aceite ou consentimento quando adequado.',
            ],
            [
                'title' => 'Contato',
                'text' => 'Dúvidas sobre esta política, dados pessoais ou solicitações relacionadas à privacidade podem ser tratadas pelos canais de atendimento informados no site.',
            ],
        ];
    @endphp

    <section class="bg-brand-50 py-16 sm:py-20">
        <div class="mx-auto max-w-4xl px-4 sm:px-6">
            <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-600">Privacidade</p>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-brand-950 sm:text-5xl">Política de Privacidade</h1>
            <p class="mt-4 text-slate-600">Esta página explica, de forma simples, como informações de contato e atendimento são tratadas hoje e como poderão ser organizadas em fases futuras do site.</p>
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
                <a href="{{ $whatsappUrl }}" @if ($isWhatsappExternal) target="_blank" rel="noopener noreferrer" @endif class="mt-6 inline-flex min-h-12 items-center rounded-full bg-action-500 px-6 py-3 text-sm font-bold text-white hover:bg-action-600">
                    Iniciar atendimento
                </a>
            </article>
        </div>
    </section>
@endsection
