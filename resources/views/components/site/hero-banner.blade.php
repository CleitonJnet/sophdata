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
    'image' => null,
    'imageAlt' => null,
    'slides' => [],
    'variant' => 'dark',
])

@php
    $isLight = $variant === 'light';
    $image = $image ?: config('sophdata.images.hero');
    $heroSlides = empty($slides)
        ? [
            [
                'eyebrow' => $eyebrow,
                'title' => $title,
                'subtitle' => $subtitle,
                'primaryButtonText' => $primaryButtonText,
                'primaryButtonUrl' => $primaryButtonUrl,
                'secondaryButtonText' => $secondaryButtonText,
                'secondaryButtonUrl' => $secondaryButtonUrl,
                'tertiaryButtonText' => $tertiaryButtonText,
                'tertiaryButtonUrl' => $tertiaryButtonUrl,
                'image' => $image,
                'imageAlt' => $imageAlt ?: $title,
            ],
        ]
        : $slides;

    $resolveImage = fn($slideImage) => str_starts_with($slideImage, 'http://') ||
    str_starts_with($slideImage, 'https://') ||
    str_starts_with($slideImage, '/')
        ? $slideImage
        : asset($slideImage);
@endphp

<section
    {{ $attributes->class([
        'relative overflow-hidden',
        'bg-brand-50 text-brand-950' => $isLight,
        'hero-grid bg-brand-950 text-white' => !$isLight,
    ]) }}>
    <div class="swiper site-hero-carousel">
        <div class="swiper-wrapper">
            @foreach ($heroSlides as $slide)
                @php
                    $slideImage = $slide['image'] ?? $image;
                    $resolvedImage = $resolveImage($slideImage);
                    $resolvedImageAlt = $slide['imageAlt'] ?? ($slide['title'] ?? $title);
                    $slidePrimaryButtonUrl = $slide['primaryButtonUrl'] ?? $primaryButtonUrl;
                    $slideSecondaryButtonUrl = $slide['secondaryButtonUrl'] ?? null;
                    $slideTertiaryButtonUrl = $slide['tertiaryButtonUrl'] ?? null;
                    $isPrimaryExternal = str_starts_with($slidePrimaryButtonUrl, 'https://wa.me/');
                    $isSecondaryExternal =
                        $slideSecondaryButtonUrl && str_starts_with($slideSecondaryButtonUrl, 'https://wa.me/');
                @endphp

                <div class="swiper-slide">
                    <div
                        class="mx-auto grid max-w-8xl items-center gap-9 px-4 py-12 sm:px-6 sm:py-16 lg:grid-cols-[1.05fr_.95fr] lg:gap-12 lg:px-8 lg:py-20 xl:py-24">
                        <div>
                            <p @class([
                                'text-sm font-bold uppercase tracking-[0.18em]',
                                'text-brand-600' => $isLight,
                                'text-brand-300' => !$isLight,
                            ])>
                                {{ $slide['eyebrow'] ?? $eyebrow }}
                            </p>
                            <h1
                                class="mt-4 max-w-3xl text-3xl font-bold leading-tight tracking-tight sm:mt-5 sm:text-5xl xl:text-6xl">
                                {{ $slide['title'] ?? $title }}
                            </h1>
                            <p @class([
                                'mt-6 max-w-2xl text-lg leading-8 sm:text-xl',
                                'text-slate-600' => $isLight,
                                'text-brand-100/80' => !$isLight,
                            ])>
                                {{ $slide['subtitle'] ?? $subtitle }}
                            </p>
                            <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                                <a href="{{ $slidePrimaryButtonUrl }}"
                                    @if ($isPrimaryExternal) target="_blank" rel="noopener noreferrer" @endif
                                    class="inline-flex min-h-12 w-full items-center justify-center rounded-full bg-action-500 px-6 py-3 text-center text-sm font-bold text-white shadow-lg shadow-action-500/20 transition hover:bg-action-600 sm:w-auto">
                                    {{ $slide['primaryButtonText'] ?? $primaryButtonText }}
                                </a>
                                @if (($slide['secondaryButtonText'] ?? null) && $slideSecondaryButtonUrl)
                                    <a href="{{ $slideSecondaryButtonUrl }}"
                                        @if ($isSecondaryExternal) target="_blank" rel="noopener noreferrer" @endif
                                        @class([
                                            'inline-flex min-h-12 w-full items-center justify-center rounded-full border px-6 py-3 text-center text-sm font-bold transition sm:w-auto',
                                            'border-brand-200 text-brand-700 hover:bg-white' => $isLight,
                                            'border-white/25 text-white hover:bg-white hover:text-brand-950' => !$isLight,
                                        ])>
                                        {{ $slide['secondaryButtonText'] }}
                                    </a>
                                @endif
                                @if (($slide['tertiaryButtonText'] ?? null) && $slideTertiaryButtonUrl)
                                    <a href="{{ $slideTertiaryButtonUrl }}" target="_blank" rel="noopener noreferrer"
                                        @class([
                                            'inline-flex min-h-12 w-full items-center justify-center rounded-full px-6 py-3 text-center text-sm font-bold transition sm:w-auto',
                                            'bg-brand-950 text-white hover:bg-brand-800' => $isLight,
                                            'bg-white text-brand-950 hover:bg-brand-50' => !$isLight,
                                        ])>
                                        {{ $slide['tertiaryButtonText'] }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <figure class="relative mx-auto w-full max-w-180">
                            <div class="absolute inset-8 rounded-full bg-brand-400/20 blur-3xl" aria-hidden="true"></div>
                            <img src="{{ $resolvedImage }}" alt="{{ $resolvedImageAlt }}"
                                width="1440" height="1040"
                                class="relative aspect-18/13 w-full rounded-3xl object-cover shadow-2xl sm:rounded-4xl"
                                loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async"
                                fetchpriority="{{ $loop->first ? 'high' : 'auto' }}">
                        </figure>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var siteHeroCarousel = new Swiper(".site-hero-carousel", {
            grabCursor: true,
            loop: true,
            effect: "creative",
            spaceBetween: 30,
            speed: 900,
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            autoplay: {
                delay: 2500,
                disableOnInteraction: true,
            },
            creativeEffect: {
                prev: {
                    shadow: true,
                    translate: ["-120%", 0, -500],
                },
                next: {
                    shadow: true,
                    translate: ["120%", 0, -500],
                },
            },
            breakpoints: {
                768: {
                    creativeEffect: {
                        prev: {
                            shadow: true,
                            translate: [0, 0, -800],
                            rotate: [180, 0, 0],
                        },
                        next: {
                            shadow: true,
                            translate: [0, 0, -800],
                            rotate: [-180, 0, 0],
                        },
                    },
                },
            },
        });
    });
</script>
