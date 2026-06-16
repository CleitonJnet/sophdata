@props([
    'activePortal' => null,
    'compact' => false,
])

@php
    $portals = config('sophdata_portals');
@endphp

<nav aria-label="Alternar entre os portais" {{ $attributes->class(['grid grid-cols-2 gap-2', 'w-full' => !$compact]) }}>
    @foreach ($portals as $portal)
        @php($isActive = $activePortal === $portal['key'])
        <a @if (!$isActive) href="{{ route($portal['route']) }}" @endif
            @if ($isActive) aria-current="page" @endif @class([
                'group flex min-h-12 items-center justify-center gap-2 rounded-xl border-x-4 border-y px-4 py-2.5 text-center text-sm font-bold transition focus-visible:outline-none',
                'border-brand-950 bg-brand-950/10 text-brand-950 ring-2 ring-gold/25 cursor-default' => $isActive,
                'border-brand-950/10 bg-white text-slate-700 hover:border-brand-950/15 hover:bg-brand-950/10 hover:text-brand-800 cursor-pointer' => !$isActive,
            ])>
            <span>{{ $portal['label'] }}</span>
            @if ($isActive)
                <span class="inline-flex size-5 items-center justify-center rounded-full bg-gold text-xs text-white"
                    aria-hidden="true">
                    ✓
                </span>
                <span class="sr-only">Portal ativo</span>
            @endif
        </a>
    @endforeach
</nav>
