@props([
    'eyebrow' => null,
    'title' => null,
    'subtitle' => null,
    'description' => null,
    'centered' => false,
    'level' => 'h2',
    'titleId' => null,
])

@php
    $headingLevel = in_array($level, ['h2', 'h3', 'h4'], true) ? $level : 'h2';
    $description = $description ?? $subtitle;
@endphp

<div {{ $attributes->class(['max-w-2xl', 'mx-auto text-center' => $centered]) }}>
    @if ($eyebrow)
        <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-600">{{ $eyebrow }}</p>
    @endif
    @if ($title)
        <{{ $headingLevel }} @if ($titleId) id="{{ $titleId }}" @endif class="mt-3 text-3xl font-bold tracking-tight text-brand-950 sm:text-4xl">{{ $title }}</{{ $headingLevel }}>
    @endif
    @if ($description)
        <p class="mt-4 text-lg leading-8 text-slate-600">{{ $description }}</p>
    @endif
</div>
