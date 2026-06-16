@props([
    'title',
    'description',
    'image' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Categoria',
    'url',
    'items' => [],
    'ctaLabel' => 'Conhecer solução',
])

<article {{ $attributes->class(['card-lift group flex h-full flex-col overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm']) }}>
    <figure>
        <img src="{{ $image }}" alt="{{ $title }}" class="aspect-video w-full object-cover" loading="lazy" decoding="async">
    </figure>
    <div class="flex flex-1 flex-col p-6">
        <h3 class="text-xl font-bold text-brand-950">{{ $title }}</h3>
        <p class="mt-3 leading-7 text-slate-600">{{ $description }}</p>
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
        <a href="{{ $url }}" class="mt-auto inline-flex min-h-11 items-center gap-2 self-start rounded-lg pt-6 text-sm font-bold text-brand-600">
            {{ $ctaLabel }} <span class="transition group-hover:translate-x-1" aria-hidden="true">→</span>
        </a>
    </div>
</article>
