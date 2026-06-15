@props(['steps'])

<ol {{ $attributes->class(['grid gap-6 md:grid-cols-3']) }}>
    @foreach ($steps as $step)
        <li class="rounded-3xl border border-slate-200 bg-white p-7 shadow-sm">
            <span class="grid size-11 place-items-center rounded-2xl bg-brand-100 text-sm font-bold text-brand-700">
                {{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}
            </span>
            <h3 class="mt-6 text-xl font-bold text-brand-950">{{ $step['title'] }}</h3>
            <p class="mt-3 leading-7 text-slate-600">{{ $step['description'] }}</p>
        </li>
    @endforeach
</ol>
