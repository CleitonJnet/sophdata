@props([
    'title' => 'O que você precisa resolver?',
    'actions' => null,
])

@php
    $whatsappUrl = sophdata_whatsapp_url();
    $defaultActions = [
        ['label' => 'Suporte para mim', 'url' => route('para-voce').'#suporte-digital-pessoal'],
        ['label' => 'Soluções para minha empresa', 'url' => route('para-empresas')],
        ['label' => 'Montagem de computador', 'url' => route('para-voce').'#montagem-e-upgrade-de-computadores'],
        ['label' => 'Criar site ou sistema', 'url' => route('para-empresas').'#sites-e-presenca-digital'],
        ['label' => 'Segurança e backup', 'url' => route('para-empresas').'#seguranca-e-backup'],
        ['label' => 'Falar no WhatsApp', 'url' => $whatsappUrl, 'external' => true],
    ];
    $items = $actions ?? $defaultActions;
@endphp

<section {{ $attributes->class(['relative z-10 px-4 sm:px-6 lg:px-8']) }}>
    <div class="mx-auto max-w-7xl rounded-3xl border border-slate-200 bg-white p-5 shadow-xl shadow-brand-950/8 sm:p-7">
        <h2 class="mb-5 text-center text-sm font-bold uppercase tracking-[0.16em] text-brand-600">{{ $title }}</h2>
        <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
            @foreach ($items as $action)
                <a
                    href="{{ $action['url'] }}"
                    @if ($action['external'] ?? false) target="_blank" rel="noopener noreferrer" @endif
                    class="flex min-h-14 items-center justify-center rounded-2xl border border-transparent bg-slate-50 px-4 py-3 text-center text-sm font-bold text-brand-950 transition hover:border-brand-600 hover:bg-brand-600 hover:text-white"
                >
                    {{ $action['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</section>
