@props([
    'title',
    'description',
    'buttonText' => null,
    'buttonUrl' => null,
    'image' => 'https://placehold.co/1200x360/0B1F4D/FFFFFF?text=Fale+com+a+SophData',
    'imageAlt' => null,
])

@php
    $isExternal = $buttonUrl && str_starts_with($buttonUrl, 'https://wa.me/');
@endphp

<section {{ $attributes->class(['bg-brand-50 px-4 py-12 sm:px-6 sm:py-16 lg:px-8']) }}>
    <div class="relative mx-auto max-w-6xl overflow-hidden rounded-3xl bg-brand-950 text-white shadow-xl sm:rounded-[2rem]">
        <figure class="absolute inset-0" aria-hidden="true">
            <img src="{{ $image }}" alt="" class="h-full w-full object-cover opacity-25" loading="lazy" decoding="async">
        </figure>
        <div class="hero-grid relative flex flex-col items-start justify-between gap-8 p-6 sm:p-10 lg:flex-row lg:items-center lg:p-12">
            <div class="max-w-2xl">
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">{{ $title }}</h2>
                <p class="mt-4 text-lg leading-8 text-brand-100/80">{{ $description }}</p>
            </div>
            @if ($buttonText && $buttonUrl)
                <a
                    href="{{ $buttonUrl }}"
                    @if ($isExternal) target="_blank" rel="noopener noreferrer" @endif
                    class="inline-flex min-h-12 w-full shrink-0 items-center justify-center rounded-full bg-action-500 px-6 py-3 text-center text-sm font-bold text-white shadow-lg transition hover:bg-action-600 sm:w-auto"
                >
                    {{ $buttonText }}
                </a>
            @endif
        </div>
    </div>
</section>
