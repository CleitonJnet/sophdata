@props([
    'title' => null,
    'description' => null,
    'buttonText' => null,
    'buttonUrl' => null,
    'primaryCta' => null,
    'whatsappMessage' => null,
    'whatsapp_message' => null,
    'secondaryButtonText' => null,
    'secondaryButtonUrl' => null,
    'secondaryCta' => null,
    'image' => null,
    'imageAlt' => null,
    'image_alt' => null,
])

@php
    $primaryCta = is_array($primaryCta) ? $primaryCta : [];
    $secondaryCta = is_array($secondaryCta) ? $secondaryCta : [];
    $buttonText = $buttonText ?? ($primaryCta['label'] ?? $primaryCta['text'] ?? null);
    $whatsappMessage = $whatsappMessage ?? $whatsapp_message ?? ($primaryCta['whatsapp_message'] ?? null);
    $whatsappUrl = filled($whatsappMessage) ? sophdata_whatsapp_url($whatsappMessage) : null;
    $buttonUrl = $whatsappUrl ?? $buttonUrl ?? ($primaryCta['url'] ?? null);
    $secondaryButtonText = $secondaryButtonText ?? ($secondaryCta['label'] ?? $secondaryCta['text'] ?? null);
    $secondaryButtonUrl = $secondaryButtonUrl ?? ($secondaryCta['url'] ?? null);
    $isExternal = $buttonUrl && str_starts_with($buttonUrl, 'https://wa.me/');
    $isSecondaryExternal = $secondaryButtonUrl && str_starts_with($secondaryButtonUrl, 'https://wa.me/');
    $image = $image ?: config('sophdata.images.banner');
    $resolvedImage = $image && (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, '/'))
        ? $image
        : ($image ? asset($image) : null);
@endphp

<section {{ $attributes->class(['bg-brand-50 px-4 py-12 sm:px-6 sm:py-16 lg:px-8']) }}>
    <div class="relative mx-auto max-w-6xl overflow-hidden rounded-3xl bg-brand-950 text-white shadow-xl sm:rounded-[2rem]">
        @if ($resolvedImage)
            <figure class="absolute inset-0" aria-hidden="true">
                <img src="{{ $resolvedImage }}" alt="" aria-hidden="true" width="1600" height="480"
                    class="h-full w-full object-cover opacity-25" loading="lazy" decoding="async">
            </figure>
        @endif
        <div class="hero-grid relative flex flex-col items-start justify-between gap-8 p-6 sm:p-10 lg:flex-row lg:items-center lg:p-12">
            <div class="max-w-2xl">
                @if ($title)
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ $title }}</h2>
                @endif
                @if ($description)
                    <p class="mt-4 text-lg leading-8 text-brand-100/80">{{ $description }}</p>
                @endif
            </div>
            <div class="flex w-full shrink-0 flex-col gap-3 sm:w-auto sm:flex-row">
                @if ($buttonText && $buttonUrl)
                    <a
                        href="{{ $buttonUrl }}"
                        @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif
                        class="inline-flex min-h-12 w-full shrink-0 items-center justify-center rounded-full bg-action-500 px-6 py-3 text-center text-sm font-bold text-white shadow-lg transition hover:bg-action-600 sm:w-auto"
                    >
                        {{ $buttonText }}
                    </a>
                @endif
                @if ($secondaryButtonText && $secondaryButtonUrl)
                    <a
                        href="{{ $secondaryButtonUrl }}"
                        @if ($isSecondaryExternal) target="_blank" rel="noopener noreferrer" @endif
                        class="inline-flex min-h-12 w-full shrink-0 items-center justify-center rounded-full border border-white/25 px-6 py-3 text-center text-sm font-bold text-white transition hover:bg-white hover:text-brand-950 sm:w-auto"
                    >
                        {{ $secondaryButtonText }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>
