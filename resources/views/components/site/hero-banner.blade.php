@props([
    'eyebrow',
    'title',
    'subtitle',
    'primaryButtonText',
    'primaryButtonUrl',
    'secondaryButtonText' => null,
    'secondaryButtonUrl' => null,
    'tertiaryButtonText' => null,
    'tertiaryButtonUrl' => null,
    'image' => 'https://placehold.co/720x520/F3F6FA/0B1F4D?text=SophData',
    'imageAlt' => null,
    'variant' => 'dark',
])

@php
    $isLight = $variant === 'light';
    $resolvedImageAlt = $imageAlt ?: $title;
    $isPrimaryExternal = str_starts_with($primaryButtonUrl, 'https://wa.me/');
    $isSecondaryExternal = $secondaryButtonUrl && str_starts_with($secondaryButtonUrl, 'https://wa.me/');
@endphp

<section {{ $attributes->class([
    'relative overflow-hidden',
    'bg-brand-50 text-brand-950' => $isLight,
    'hero-grid bg-brand-950 text-white' => ! $isLight,
]) }}>
    <div class="mx-auto grid max-w-7xl items-center gap-9 px-4 py-12 sm:px-6 sm:py-16 lg:grid-cols-[1.05fr_.95fr] lg:gap-12 lg:px-8 lg:py-20 xl:py-24">
        <div>
            <p @class([
                'text-sm font-bold uppercase tracking-[0.18em]',
                'text-brand-600' => $isLight,
                'text-brand-300' => ! $isLight,
            ])>
                {{ $eyebrow }}
            </p>
            <h1 class="mt-4 max-w-3xl text-3xl font-bold leading-tight tracking-tight sm:mt-5 sm:text-5xl xl:text-6xl">
                {{ $title }}
            </h1>
            <p @class([
                'mt-6 max-w-2xl text-lg leading-8 sm:text-xl',
                'text-slate-600' => $isLight,
                'text-brand-100/80' => ! $isLight,
            ])>
                {{ $subtitle }}
            </p>
            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                <a
                    href="{{ $primaryButtonUrl }}"
                    @if ($isPrimaryExternal) target="_blank" rel="noopener noreferrer" @endif
                    class="inline-flex min-h-12 w-full items-center justify-center rounded-full bg-action-500 px-6 py-3 text-center text-sm font-bold text-white shadow-lg shadow-action-500/20 transition hover:bg-action-600 sm:w-auto"
                >
                    {{ $primaryButtonText }}
                </a>
                @if ($secondaryButtonText && $secondaryButtonUrl)
                    <a
                        href="{{ $secondaryButtonUrl }}"
                        @if ($isSecondaryExternal) target="_blank" rel="noopener noreferrer" @endif
                        @class([
                            'inline-flex min-h-12 w-full items-center justify-center rounded-full border px-6 py-3 text-center text-sm font-bold transition sm:w-auto',
                            'border-brand-200 text-brand-700 hover:bg-white' => $isLight,
                            'border-white/25 text-white hover:bg-white hover:text-brand-950' => ! $isLight,
                        ])
                    >
                        {{ $secondaryButtonText }}
                    </a>
                @endif
                @if ($tertiaryButtonText && $tertiaryButtonUrl)
                    <a
                        href="{{ $tertiaryButtonUrl }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        @class([
                            'inline-flex min-h-12 w-full items-center justify-center rounded-full px-6 py-3 text-center text-sm font-bold transition sm:w-auto',
                            'bg-brand-950 text-white hover:bg-brand-800' => $isLight,
                            'bg-white text-brand-950 hover:bg-brand-50' => ! $isLight,
                        ])
                    >
                        {{ $tertiaryButtonText }}
                    </a>
                @endif
            </div>
        </div>

        <figure class="relative mx-auto w-full max-w-[720px]">
            <div class="absolute inset-8 rounded-full bg-brand-400/20 blur-3xl"></div>
            <img
                src="{{ $image }}"
                alt="{{ $resolvedImageAlt }}"
                class="relative aspect-[18/13] w-full rounded-3xl object-cover shadow-2xl sm:rounded-[2rem]"
                decoding="async"
                fetchpriority="high"
            >
        </figure>
    </div>
</section>
