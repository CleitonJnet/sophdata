@props([
    'level',
])

<article @class([
    'relative flex h-full flex-col rounded-3xl bg-white p-7',
    'border-2 border-gold shadow-xl shadow-brand-950/10 lg:-translate-y-2' => $level['featured'],
    'border border-slate-200 shadow-sm' => ! $level['featured'],
])>
    @if ($level['featured'])
        <span class="absolute -top-3 left-6 rounded-full bg-gold px-4 py-1.5 text-xs font-bold text-brand-950">
            Mais escolhido
        </span>
    @endif

    <p class="text-xs font-bold uppercase tracking-[0.16em] text-brand-600">{{ $level['positioning'] }}</p>
    <h3 class="mt-3 text-2xl font-bold text-brand-950">{{ $level['title'] }}</h3>
    <p class="mt-4 leading-7 text-slate-600">{{ $level['description'] }}</p>

    <ul class="mt-6 grid gap-3 text-sm text-slate-700">
        @foreach ($level['items'] as $item)
            <li class="flex gap-3">
                <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                <span>{{ $item }}</span>
            </li>
        @endforeach
    </ul>
</article>
