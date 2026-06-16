@props([
    'activePortal' => null,
    'compact' => false,
])

@php
    $portals = config('sophdata_portals');
@endphp

<nav
    aria-label="Alternar entre os portais"
    {{ $attributes->class([
        'grid grid-cols-2 gap-2',
        'w-full' => ! $compact,
    ]) }}
>
    @foreach ($portals as $portal)
        @php($isActive = $activePortal === $portal['key'])
        <a
            href="{{ route($portal['route']) }}"
            @if ($isActive) aria-current="page" @endif
            @class([
                'group flex min-h-12 items-center justify-center gap-2 rounded-xl border px-4 py-2.5 text-center text-sm font-bold transition focus-visible:outline-none',
                'border-brand-600 bg-brand-50 text-brand-800 shadow-sm ring-2 ring-gold/25' => $isActive,
                'border-slate-200 bg-white text-slate-700 hover:border-brand-300 hover:bg-brand-50 hover:text-brand-800' => ! $isActive,
            ])
        >
            <span>{{ $portal['label'] }}</span>
            @if ($isActive)
                <span class="inline-flex size-5 items-center justify-center rounded-full bg-gold text-xs text-brand-950" aria-hidden="true">
                    ✓
                </span>
                <span class="sr-only">Portal ativo</span>
            @endif
        </a>
    @endforeach
</nav>
