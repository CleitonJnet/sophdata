@php
    $solutions = [
        ['label' => 'Suporte Técnico', 'url' => route('para-voce').'#suporte-digital-pessoal'],
        ['label' => 'Segurança e Backup', 'url' => route('para-empresas').'#seguranca-e-backup'],
        ['label' => 'Sites e Sistemas', 'url' => route('para-empresas').'#sites-e-presenca-digital'],
        ['label' => 'Redes e Infraestrutura', 'url' => route('para-empresas').'#infraestrutura-e-redes'],
        ['label' => 'Montagem de Computadores', 'url' => route('para-voce').'#montagem-e-upgrade-de-computadores'],
        ['label' => 'Consultoria de TI', 'url' => route('para-empresas').'#consultoria-e-treinamentos'],
    ];
    $whatsappUrl = sophdata_whatsapp_url();
@endphp

<footer class="bg-brand-950 text-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-16 sm:px-6 md:grid-cols-2 lg:grid-cols-4 lg:px-8">
        <div>
            <x-brand light />
            <p class="mt-5 leading-7 text-brand-100/85">{{ config('sophdata.brand.slogan') }}</p>
            <p class="mt-4 text-sm leading-6 text-brand-100/75">
                Soluções em TI para pessoas, pequenos negócios e instituições.
            </p>
        </div>

        <div>
            <h2 class="font-bold">Links principais</h2>
            <nav class="mt-5 grid gap-1 text-sm text-brand-100/85" aria-label="Navegação do rodapé">
                @foreach (config('sophdata.links') as $link)
                    <a href="{{ route($link['route']) }}" class="flex min-h-11 items-center rounded-lg transition hover:text-white">{{ $link['label'] }}</a>
                @endforeach
                <a href="{{ route('politica-de-privacidade') }}" class="flex min-h-11 items-center rounded-lg transition hover:text-white">Política de Privacidade</a>
            </nav>
        </div>

        <div>
            <h2 class="font-bold">Principais soluções</h2>
            <nav class="mt-5 grid gap-1 text-sm text-brand-100/85" aria-label="Principais soluções">
                @foreach ($solutions as $solution)
                    <a href="{{ $solution['url'] }}" class="flex min-h-11 items-center rounded-lg transition hover:text-white">{{ $solution['label'] }}</a>
                @endforeach
            </nav>
        </div>

        <div>
            <h2 class="font-bold">Contato</h2>
            <div class="mt-5 grid gap-1 text-sm text-brand-100/85">
                <a href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer" class="flex min-h-11 items-center rounded-lg transition hover:text-white">
                    WhatsApp: {{ config('sophdata.brand.whatsapp') }}
                </a>
                <a href="mailto:{{ config('sophdata.brand.email') }}" class="flex min-h-11 items-center break-all rounded-lg transition hover:text-white">
                    {{ config('sophdata.brand.email') }}
                </a>
                <p>{{ config('sophdata.brand.region') }}</p>
            </div>
            <x-whatsapp-link class="mt-6">Falar no WhatsApp</x-whatsapp-link>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-6 pr-20 text-xs text-brand-100/75 sm:flex-row sm:items-center sm:justify-between sm:px-6 sm:pr-24 lg:px-8">
            <p>© {{ date('Y') }} {{ config('sophdata.brand.name') }}. Todos os direitos reservados.</p>
            <a href="{{ route('politica-de-privacidade') }}" class="transition hover:text-white">Política de Privacidade</a>
        </div>
    </div>
</footer>
