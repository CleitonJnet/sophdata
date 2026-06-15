@props([
    'package',
    'whatsappNumber' => null,
])

@php
    $isFeatured = (bool) ($package['featured'] ?? false);
    $number = $whatsappNumber ?: config('sophdata.brand.whatsapp');
    $message = $package['whatsapp_message'] ?? "Olá, gostaria de saber mais sobre o pacote {$package['name']}.";
    $url = sophdata_whatsapp_url($message, $number);
    $levelLabels = [
        'essential' => 'Essencial',
        'professional' => 'Profissional',
        'complete' => 'Completo',
    ];
    $level = $levelLabels[$package['level']] ?? $package['level'];
@endphp

<article {{ $attributes->class([
    'relative flex h-full flex-col rounded-3xl bg-white p-6 sm:p-7',
    'border-2 border-brand-500 shadow-xl shadow-brand-900/10 lg:-translate-y-2' => $isFeatured,
    'border border-slate-200 shadow-sm' => ! $isFeatured,
]) }}>
    @if ($isFeatured)
        <span class="absolute -top-3 left-6 rounded-full bg-brand-600 px-4 py-1.5 text-xs font-bold text-white shadow" aria-label="Pacote em destaque">
            {{ $package['badge'] ?: 'Mais escolhido' }}
        </span>
    @endif

    <p class="text-xs font-bold uppercase tracking-[0.16em] text-brand-600">
        {{ $isFeatured ? 'Plano recomendado · ' : '' }}{{ $level }}
    </p>
    <h3 class="mt-3 text-2xl font-bold text-brand-950">{{ $package['name'] }}</h3>
    <p class="mt-2 font-semibold text-slate-700">{{ $package['subtitle'] }}</p>
    <p class="mt-4 leading-7 text-slate-600">{{ $package['description'] }}</p>

    <ul class="mt-6 grid gap-3 text-sm text-slate-700">
        @foreach ($package['included_items'] as $item)
            <li class="flex gap-3">
                <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                {{ $item }}
            </li>
        @endforeach
    </ul>

    <a
        href="{{ $url }}"
        target="_blank"
        rel="noopener noreferrer"
        @class([
            'mt-8 inline-flex min-h-12 items-center justify-center rounded-full px-5 py-3 text-center text-sm font-bold transition',
            'bg-brand-600 text-white hover:bg-brand-700' => $isFeatured,
            'bg-action-500 text-white hover:bg-action-600' => ! $isFeatured,
        ])
    >
        {{ $package['button_text'] }}
    </a>
</article>
