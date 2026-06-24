@props(['items'])

<div {{ $attributes->class(['grid gap-4']) }}>
    @foreach ($items as $item)
        <details class="group rounded-2xl border border-slate-200 bg-slate-50 p-6">
            <summary class="flex min-h-11 cursor-pointer list-none items-center justify-between gap-4 rounded-lg font-bold text-brand-950">
                {{ $item['question'] }}
                <span class="text-brand-600 transition group-open:rotate-180" aria-hidden="true">⌄</span>
            </summary>
            <p class="mt-4 leading-7 text-slate-600">{{ $item['answer'] }}</p>
        </details>
    @endforeach
</div>
