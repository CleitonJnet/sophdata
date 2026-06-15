@props(['light' => false])

<a href="{{ route('home') }}" {{ $attributes->class(['inline-flex items-center gap-2.5']) }} aria-label="{{ config('sophdata.brand.name') }} - início">
    <span @class([
        'grid size-9 place-items-center rounded-xl',
        'bg-white/15 text-white ring-1 ring-white/20' => $light,
        'bg-brand-600 text-white shadow-sm shadow-brand-600/20' => ! $light,
    ])>
        <span class="text-xs font-black tracking-tight" aria-hidden="true">{{ config('sophdata.brand.short_name') }}</span>
    </span>
    <span @class(['text-xl font-bold tracking-tight', 'text-white' => $light, 'text-brand-950' => ! $light])>
        {{ config('sophdata.brand.name') }}
    </span>
</a>
