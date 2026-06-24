@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'imageAlt' => null,
    'image_alt' => null,
    'url' => null,
    'items' => [],
    'ctaLabel' => 'Conhecer solução',
    'level' => 'h3',
])

@php
    $image = $image ?: config('sophdata.images.category_card');
    $resolvedImage = $image && (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, '/'))
        ? $image
        : ($image ? asset($image) : null);
    $resolvedImageAlt = $imageAlt ?? $image_alt ?? ($title ? "Solução de {$title}" : 'Solução SophData');
    $headingLevel = in_array($level, ['h2', 'h3', 'h4'], true) ? $level : 'h3';
    $linkClass = 'absolute bottom-6 left-6 inline-flex min-h-11 w-fit items-center gap-2 rounded-lg border-x-4 border-y-2 border-brand-950 px-4 py-2 text-sm font-bold text-brand-950 transition group-hover:border-brand-950 group-hover:bg-brand-950 group-hover:text-white';
@endphp

<article
    {{ $attributes->class(['category-card card-lift group relative flex h-full flex-col overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm swiper-slide']) }}>
    @if ($resolvedImage)
        <figure>
            <img src="{{ $resolvedImage }}" alt="{{ $resolvedImageAlt }}" width="1280" height="720"
                class="aspect-video w-full object-cover" loading="lazy" decoding="async">
        </figure>
    @endif
    <div class="flex flex-1 flex-col p-6 pb-24">
        <div>
            @if ($title)
                <{{ $headingLevel }} class="h-12 text-xl font-bold text-brand-950">{{ $title }}</{{ $headingLevel }}>
            @endif
            @if ($description)
                <p class="mt-3 leading-7 text-slate-600">{{ $description }}</p>
            @endif
            @if (filled($items))
                <ul class="mt-5 grid gap-2 text-sm text-slate-600">
                    @foreach ($items as $item)
                        <li class="flex gap-2">
                            <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                            {{ $item }}
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    @if ($url)
        <a href="{{ $url }}" class="{{ $linkClass }}">
            {{ $ctaLabel }} <span class="transition group-hover:translate-x-1" aria-hidden="true">→</span>
        </a>
    @endif
</article>
