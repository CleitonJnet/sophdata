@extends('layouts.app')

@section('content')
    @php
        $needsProfile = blank(auth()->user()->phone) || blank(auth()->user()->customer_type);
    @endphp

    <section class="rounded-lg border border-slate-200 bg-white p-8 shadow-sm">
        <p class="text-sm font-bold uppercase tracking-wide text-brand-700">Painel</p>
        <h1 class="mt-3 text-3xl font-black tracking-tight text-brand-950">Painel do cliente SophData</h1>
        <p class="mt-4 max-w-2xl text-lg text-slate-700">
            Em breve, você poderá abrir e acompanhar seus atendimentos por aqui.
        </p>

        @if ($needsProfile)
            <div class="mt-6 rounded-lg border border-brand-200 bg-brand-50 p-4 text-sm text-brand-950">
                <p class="font-bold">Complete seu perfil para agilizar futuros atendimentos.</p>
                <p class="mt-1 text-brand-900">Telefone e tipo de cliente ajudam a SophData a direcionar melhor o retorno quando o painel de atendimentos estiver disponível.</p>
            </div>
        @endif

        <div class="mt-8 flex flex-wrap gap-3">
            <a href="{{ route('profile.edit') }}" class="rounded-md bg-brand-950 px-5 py-3 text-sm font-bold text-white hover:bg-brand-800">
                Editar perfil
            </a>
            <a href="{{ route('portal.business') }}" class="rounded-md bg-brand-950 px-5 py-3 text-sm font-bold text-white hover:bg-brand-800">
                Voltar para o site
            </a>
            <a href="{{ route('business.software.index') }}" class="rounded-md border border-slate-300 px-5 py-3 text-sm font-bold text-slate-700 hover:border-brand-300 hover:text-brand-800">
                Ver soluções para empresas
            </a>
            <a href="{{ route('portal.personal') }}" class="rounded-md border border-slate-300 px-5 py-3 text-sm font-bold text-slate-700 hover:border-brand-300 hover:text-brand-800">
                Ver atendimento Para Você
            </a>
        </div>
    </section>
@endsection
