@php
    $profiles = [
        [
            'eyebrow' => 'Soluções pessoais',
            'title' => 'Para Você',
            'description' => 'Soluções para computador, internet, segurança digital, estudos, carreira, produtividade e montagem de PCs.',
            'image' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Para+Voce',
            'url' => route('para-voce'),
        ],
        [
            'eyebrow' => 'Soluções corporativas',
            'title' => 'Para Empresas',
            'description' => 'Suporte, redes, segurança, sites, sistemas, automação, consultoria e renovação de computadores para pequenos negócios.',
            'image' => 'https://placehold.co/640x360/F3F6FA/0B1F4D?text=Para+Empresas',
            'url' => route('para-empresas'),
        ],
    ];
@endphp

<section {{ $attributes->class(['px-4 sm:px-6 lg:px-8']) }}>
    <div class="mx-auto grid max-w-6xl gap-6 md:grid-cols-2">
        @foreach ($profiles as $profile)
            <a href="{{ $profile['url'] }}" class="card-lift group overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
                <img src="{{ $profile['image'] }}" alt="{{ $profile['title'] }}" class="aspect-video w-full object-cover">
                <span class="block p-7">
                    <span class="block text-sm font-bold text-brand-600">{{ $profile['eyebrow'] }}</span>
                    <h3 class="mt-2 text-2xl font-bold text-brand-950">{{ $profile['title'] }}</h3>
                    <span class="mt-3 block leading-7 text-slate-600">{{ $profile['description'] }}</span>
                    <span class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-brand-600">
                        Ver soluções <b class="transition group-hover:translate-x-1" aria-hidden="true">→</b>
                    </span>
                </span>
            </a>
        @endforeach
    </div>
</section>
