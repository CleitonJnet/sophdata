@props([
    'packages' => [],
])

@php
    $packages = collect($packages)->filter(fn ($package): bool => is_array($package))->values()->all();
    $comparisonRows = [
        [
            'label' => 'Indicado para',
            'values' => array_map(fn (array $package): string => $package['best_for'] ?? '', $packages),
        ],
        [
            'label' => 'Nível de atendimento',
            'values' => ['Pontual e objetivo', 'Organizado e recomendado', 'Amplo e contínuo'],
        ],
        [
            'label' => 'Organização',
            'values' => ['Essencial', 'Estruturada', 'Completa e documentada'],
        ],
        [
            'label' => 'Segurança',
            'values' => ['Boas práticas básicas', 'Revisão e melhorias', 'Prevenção e continuidade'],
        ],
        [
            'label' => 'Acompanhamento',
            'values' => ['Orientação final', 'Após a entrega', 'Ampliado conforme proposta'],
        ],
        [
            'label' => 'Documentação',
            'values' => ['Resumo da entrega', 'Registro das melhorias', 'Documentação completa'],
        ],
        [
            'label' => 'Melhor escolha',
            'values' => ['Para começar', 'Melhor equilíbrio', 'Maior cobertura'],
        ],
    ];
@endphp

@if (filled($packages))
<div {{ $attributes->class(['overflow-x-auto rounded-3xl border border-slate-200 bg-white shadow-sm']) }}>
    <table class="w-full min-w-[760px] border-collapse text-left">
        <caption class="sr-only">Comparação entre os pacotes Essencial, Profissional e Completo</caption>
        <thead class="bg-brand-950 text-white">
            <tr>
                <th scope="col" class="px-5 py-4 text-sm font-bold">Critério</th>
                @foreach ($packages as $package)
                    <th scope="col" @class([
                        'px-5 py-4 text-sm font-bold',
                        'bg-brand-700' => (bool) ($package['featured'] ?? false),
                    ])>
                        {{ $package['level_label'] ?? $package['name'] ?? $package['title'] ?? 'Pacote' }}
                        @if ($package['featured'] ?? false)
                            <span class="mt-1 block text-xs font-semibold text-brand-100">Mais escolhido</span>
                        @endif
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200">
            @foreach ($comparisonRows as $row)
                <tr class="align-top odd:bg-white even:bg-slate-50">
                    <th scope="row" class="w-44 px-5 py-4 text-sm font-bold text-brand-950">{{ $row['label'] }}</th>
                    @foreach ($row['values'] as $value)
                        <td class="px-5 py-4 text-sm leading-6 text-slate-600">{{ $value }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
