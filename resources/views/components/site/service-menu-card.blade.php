@props([
    'category' => [],
    'routeName' => null,
    'mobile' => false,
])

@php
    $category = is_array($category) ? $category : [];
    $isActive = request()->route('category') === ($category['slug'] ?? null);
    $displayTitle = $category['menu_title'] ?? $category['title'] ?? null;
    $description = $category['menu_description'] ?? $category['description'] ?? null;
    $imageAlt = $category['image_alt'] ?? "Serviço de {$displayTitle}";
    $menuImage = $category['menu_image'] ?? config('sophdata.images.menu_card');
    $mobileImage = $category['mobile_image'] ?? config('sophdata.images.mobile_thumbnail');
    $resolvedMenuImage = $menuImage && (str_starts_with($menuImage, 'http://') || str_starts_with($menuImage, 'https://') || str_starts_with($menuImage, '/'))
        ? $menuImage
        : ($menuImage ? asset($menuImage) : null);
    $resolvedMobileImage = $mobileImage && (str_starts_with($mobileImage, 'http://') || str_starts_with($mobileImage, 'https://') || str_starts_with($mobileImage, '/'))
        ? $mobileImage
        : ($mobileImage ? asset($mobileImage) : null);
    $url = $routeName && filled($category['slug'] ?? null) ? route($routeName, $category['slug']) : ($category['url'] ?? $category['route'] ?? null);
@endphp

@if ($url && $displayTitle)
<a
    href="{{ $url }}"
    @if ($isActive) aria-current="page" @endif
    @class([
        'group rounded-2xl transition focus-visible:outline-none',
        'flex min-h-24 items-center gap-4 border bg-white p-3 hover:border-brand-300 hover:bg-brand-50' => $mobile,
        'block overflow-hidden border bg-white shadow-sm hover:-translate-y-0.5 hover:border-brand-300 hover:shadow-lg' => ! $mobile,
        'border-gold ring-2 ring-gold/20' => $isActive,
        'border-slate-200' => ! $isActive,
    ])
>
    @if ($mobile)
        @if ($resolvedMobileImage)
            <figure class="shrink-0">
                <img
                    src="{{ $resolvedMobileImage }}"
                    alt="{{ $imageAlt }}"
                    width="320"
                    height="200"
                    class="h-16 w-24 rounded-xl object-cover"
                    loading="lazy"
                    decoding="async"
                >
            </figure>
        @endif
        <span class="min-w-0">
            <strong class="block text-sm text-brand-950">{{ $displayTitle }}</strong>
            @if ($description)
                <span class="mt-1 line-clamp-2 block text-xs leading-5 text-slate-500">{{ $description }}</span>
            @endif
            @if ($isActive)
                <span class="mt-1 block text-xs font-bold text-brand-700">Serviço ativo</span>
            @endif
        </span>
    @else
        <figure>
            @if ($resolvedMenuImage)
                <img
                    src="{{ $resolvedMenuImage }}"
                    alt="{{ $imageAlt }}"
                    width="640"
                    height="360"
                    class="aspect-[16/9] w-full object-cover"
                    loading="lazy"
                    decoding="async"
                >
            @endif
            <figcaption class="p-4">
                <strong class="block text-base text-brand-950 group-hover:text-brand-700">{{ $displayTitle }}</strong>
                @if ($description)
                    <span class="mt-2 line-clamp-2 block text-sm leading-5 text-slate-500">{{ $description }}</span>
                @endif
            </figcaption>
        </figure>
    @endif
</a>
@endif
