@props([
    'portal' => null,
    'light' => false,
])

@php
    $activePortal = $portal ?? (request()->routeIs('portal.personal*') ? 'personal' : 'business');
    $homeRoute = config("sophdata_portals.{$activePortal}.route", 'portal.business');
    $symbolPath = config('sophdata.logos.symbol');
    $wordmarkPath = config('sophdata.logos.wordmark');
    $hasRealLogo =
        is_string($symbolPath) &&
        is_string($wordmarkPath) &&
        file_exists(public_path($symbolPath)) &&
        file_exists(public_path($wordmarkPath));
@endphp

<a href="{{ route($homeRoute) }}" aria-label="Ir para o portal principal da SophData"
    {{ $attributes->class(['inline-flex items-center gap-2 rounded-xl', 'bg-white px-3 py-2' => $light]) }}>
    @if ($hasRealLogo)
        <img src="{{ asset($symbolPath) }}" alt="SophData" width="147" height="85" class="h-9 w-auto sm:h-10"
            decoding="async">
        <img src="{{ asset($wordmarkPath) }}" alt="" aria-hidden="true" width="176" height="35"
            class="h-8 w-auto" decoding="async">
    @else
        <span class="grid size-11 place-items-center rounded-xl bg-brand-950 font-bold text-white" aria-hidden="true">
            {{ config('sophdata.logos.fallback', 'SD') }}
        </span>
        <span @class([
            'font-bold',
            'text-brand-950' => !$light,
            'text-brand-950' => $light,
        ])>SophData</span>
    @endif
</a>
