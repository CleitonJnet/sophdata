@props([
    'category',
    'routeName',
    'mobile' => false,
])

@php
    $isActive = request()->route('category') === ($category['slug'] ?? null);
    $displayTitle = $category['menu_title'] ?? $category['title'];
    $menuImage = $category['menu_image'] ?? config('sophdata.images.menu_card');
    $mobileImage = $category['mobile_image'] ?? config('sophdata.images.mobile_thumbnail');
    $resolvedMenuImage = str_starts_with($menuImage, 'http://') || str_starts_with($menuImage, 'https://') || str_starts_with($menuImage, '/')
        ? $menuImage
        : asset($menuImage);
    $resolvedMobileImage = str_starts_with($mobileImage, 'http://') || str_starts_with($mobileImage, 'https://') || str_starts_with($mobileImage, '/')
        ? $mobileImage
        : asset($mobileImage);
@endphp

<a
    href="{{ route($routeName, $category['slug']) }}"
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
        <figure class="shrink-0">
            <img
                src="{{ $resolvedMobileImage }}"
                alt="Imagem de {{ $displayTitle }}"
                width="320"
                height="200"
                class="h-16 w-24 rounded-xl object-cover"
                loading="lazy"
                decoding="async"
            >
        </figure>
        <span class="min-w-0">
            <strong class="block text-sm text-brand-950">{{ $displayTitle }}</strong>
            <span class="mt-1 line-clamp-2 block text-xs leading-5 text-slate-500">{{ $category['menu_description'] }}</span>
            @if ($isActive)
                <span class="mt-1 block text-xs font-bold text-brand-700">Serviço ativo</span>
            @endif
        </span>
    @else
        <figure>
            <img
                src="{{ $resolvedMenuImage }}"
                alt="Imagem de {{ $displayTitle }}"
                width="640"
                height="360"
                class="aspect-[16/9] w-full object-cover"
                loading="lazy"
                decoding="async"
            >
            <figcaption class="p-4">
                <strong class="block text-base text-brand-950 group-hover:text-brand-700">{{ $displayTitle }}</strong>
                <span class="mt-2 line-clamp-2 block text-sm leading-5 text-slate-500">{{ $category['menu_description'] }}</span>
            </figcaption>
        </figure>
    @endif
</a>
