@props([
    'package' => [],
    'whatsappNumber' => null,
])

@php
    $package = is_array($package) ? $package : [];
    $isFeatured = (bool) ($package['featured'] ?? false);
    $number = $whatsappNumber ?: config('sophdata.brand.whatsapp');
    $packageName = $package['name'] ?? $package['title'] ?? 'Pacote SophData';
    $message = $package['whatsapp_message'] ?? "Olá, gostaria de saber mais sobre o pacote {$packageName}.";
    $url = sophdata_whatsapp_url($message, $number);
    $level = $package['level_label'] ?? $package['level'] ?? 'Pacote';
    $badge = $isFeatured ? ($package['badge'] ?? 'Mais escolhido') : null;
    $positioning = $package['positioning'] ?? null;
    $subtitle = $package['subtitle'] ?? null;
    $headerLabel = $positioning && $positioning !== $badge ? "{$positioning} · {$level}" : $level;
    $showSubtitle = filled($subtitle) && $subtitle !== $badge;
    $includedItems = $package['included_items'] ?? $package['items'] ?? [];
@endphp

<article {{ $attributes->class([
    'relative flex h-full flex-col rounded-3xl bg-white p-6 sm:p-7',
    'border-2 border-gold shadow-xl shadow-brand-900/10 lg:-translate-y-2' => $isFeatured,
    'border border-slate-200 shadow-sm' => ! $isFeatured,
]) }}>
    @if ($badge)
        <span class="absolute -top-3 left-6 rounded-full bg-gold px-4 py-1.5 text-xs font-bold text-brand-950 shadow">
            {{ $badge }}
        </span>
    @endif

    <p class="text-xs font-bold uppercase tracking-[0.16em] text-brand-600">
        {{ $headerLabel }}
    </p>
    <h3 class="mt-3 text-2xl font-bold text-brand-950">{{ $packageName }}</h3>
    @if ($showSubtitle)
        <p class="mt-2 font-semibold text-slate-700">{{ $subtitle }}</p>
    @endif
    @if (filled($package['description'] ?? null))
        <p class="mt-4 leading-7 text-slate-600">{{ $package['description'] }}</p>
    @endif
    @if (filled($package['best_for'] ?? null))
        <p class="mt-4 rounded-2xl bg-brand-50 p-4 text-sm font-semibold leading-6 text-brand-950">
            Para quem é indicado: {{ $package['best_for'] }}
        </p>
    @endif

    @if (filled($package['commercial_summary'] ?? null))
        <div class="mt-5">
            <h4 class="text-sm font-bold text-brand-950">O que resolve</h4>
            <p class="mt-2 text-sm leading-6 text-slate-600">{{ $package['commercial_summary'] }}</p>
        </div>
    @endif

    @if (filled($includedItems))
        <h4 class="mt-6 text-sm font-bold text-brand-950">Itens inclusos</h4>
        <ul class="mt-6 grid gap-3 text-sm text-slate-700">
            @foreach ($includedItems as $item)
                <li class="flex gap-3">
                    <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                    {{ $item }}
                </li>
            @endforeach
        </ul>
    @endif

    @if (filled($package['level'] ?? null))
        <p class="mt-6 rounded-2xl border border-slate-200 p-4 text-sm leading-6 text-slate-500">
        @if (($package['level'] ?? null) === 'essential')
            Escopo focado na necessidade principal, sem acompanhamento ampliado.
        @elseif (($package['level'] ?? null) === 'professional')
            Inclui tudo do Essencial, acrescenta organização, melhorias e acompanhamento, com o melhor equilíbrio entre custo e benefício.
        @else
            Inclui tudo do Profissional e acrescenta prevenção, documentação e continuidade.
        @endif
        </p>
    @endif

    @if ($url && filled($package['cta_label'] ?? null))
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
            {{ $package['cta_label'] }}
        </a>
    @endif
</article>
