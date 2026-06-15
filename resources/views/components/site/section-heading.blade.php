@props([
    'eyebrow',
    'title',
    'description' => null,
    'centered' => false,
])

<div {{ $attributes->class(['max-w-2xl', 'mx-auto text-center' => $centered]) }}>
    <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-600">{{ $eyebrow }}</p>
    <h2 class="mt-3 text-3xl font-bold tracking-tight text-brand-950 sm:text-4xl">{{ $title }}</h2>
    @if ($description)
        <p class="mt-4 text-lg leading-8 text-slate-600">{{ $description }}</p>
    @endif
</div>
