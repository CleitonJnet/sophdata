@php
    $linkIconPaths = [
        'building' => [
            'M4 21h16',
            'M6 21V7.8c0-1 .7-1.9 1.7-2.2l5-1.7A2 2 0 0 1 15.3 5l1.7 1.1c.6.4 1 1 1 1.8V21',
            'M9 10h.01M13 10h.01M9 14h.01M13 14h.01M9 18h.01M13 18h.01',
        ],
        'user' => ['M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z', 'M4.5 21a7.5 7.5 0 0 1 15 0'],
        'code' => [
            'M4.75 5.75A2.75 2.75 0 0 1 7.5 3h9a2.75 2.75 0 0 1 2.75 2.75v12.5A2.75 2.75 0 0 1 16.5 21h-9a2.75 2.75 0 0 1-2.75-2.75V5.75Z',
            'm10 9-2.5 3L10 15',
            'm14 9 2.5 3L14 15',
        ],
        'shield' => ['M12 21s7-3.5 7-10V5.8L12 3 5 5.8V11c0 6.5 7 10 7 10Z', 'm8.8 12.2 2 2 4.4-4.9'],
        'about' => ['M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z', 'M12 11.5V16', 'M12 8h.01'],
        'contact' => [
            'M4.75 6.75A2.75 2.75 0 0 1 7.5 4h9a2.75 2.75 0 0 1 2.75 2.75v10.5A2.75 2.75 0 0 1 16.5 20h-9a2.75 2.75 0 0 1-2.75-2.75V6.75Z',
            'm6.5 8 5.5 4 5.5-4',
        ],
        'privacy' => [
            'M8 10V7a4 4 0 0 1 8 0v3',
            'M6.5 10h11v8.25A2.75 2.75 0 0 1 14.75 21h-5.5A2.75 2.75 0 0 1 6.5 18.25V10Z',
            'M12 14v3',
        ],
    ];

    $primaryLinks = [
        [
            'label' => 'Sites, Sistemas e Automações',
            'description' => 'Sites, sistemas, automações e soluções digitais para organizar serviços, dados e processos.',
            'href' => route('business.software.index'),
            'icon' => 'code',
            'tone' => 'brand',
            'image' => 'img/sophdata/services/business/sites-e-sistemas.webp',
        ],
        [
            'label' => 'TI para empresas',
            'description' => 'Suporte, redes, segurança e estrutura digital para a operação funcionar melhor.',
            'href' => route('portal.business'),
            'icon' => 'building',
            'tone' => 'gold',
            'image' => 'img/sophdata/portals/business-hero.webp',
        ],
        [
            'label' => 'Atendimento pessoal',
            'description' => 'Ajuda clara para computador, Wi-Fi, backup, estudos, carreira e rotina digital.',
            'href' => route('portal.personal'),
            'icon' => 'user',
            'tone' => 'silver',
            'image' => 'img/sophdata/portals/personal-hero.webp',
        ],
        [
            'label' => 'Servidores e Ambientes',
            'description' => 'Arquivos, permissões, backup e ambientes corporativos para reduzir riscos e retrabalho.',
            'href' => route('business.servers.index'),
            'icon' => 'shield',
            'tone' => 'gold',
            'image' => 'img/sophdata/services/business/seguranca-e-backup.webp',
        ],
    ];

    $institutionalLinks = [
        [
            'label' => 'Privacidade',
            'href' => route('site.privacy'),
            'icon' => 'privacy',
        ],
    ];

    $footerPrinciples = [
        ['title' => 'Diagnóstico claro', 'text' => 'Você entende prioridade, impacto e próximo passo.'],
        ['title' => 'Execução organizada', 'text' => 'Cada solução nasce com escopo, critério e orientação de uso.'],
        ['title' => 'Evolução contínua', 'text' => 'A tecnologia acompanha a rotina, não atrapalha o trabalho.'],
    ];

    $footerLogoRoute = request()->routeIs('portal.personal*') ? 'portal.personal' : 'portal.business';
@endphp

<footer class="relative isolate overflow-hidden bg-[#071a35] text-white">
    <div class="absolute inset-0 -z-10 opacity-40"
        style="background-image: linear-gradient(rgba(185, 221, 255, .09) 1px, transparent 1px), linear-gradient(90deg, rgba(185, 221, 255, .09) 1px, transparent 1px); background-size: 42px 42px;">
    </div>
    <div class="absolute inset-x-0 top-0 -z-10 h-px bg-gold-light/70"></div>

    <div class="mx-auto max-w-8xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
        <div class="grid gap-12 lg:grid-cols-[minmax(0,1fr)_410px] lg:items-start">
            <section class="text-center sm:text-left" aria-label="Assinatura institucional da SophData">
                <a href="{{ route($footerLogoRoute) }}" aria-label="Ir para o portal principal da SophData"
                    class="inline-flex items-center justify-center gap-3 sm:justify-start">
                    <svg viewBox="0 0 555 320" class="h-12 w-auto shrink-0 sm:h-14" fill="none"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path
                            d="M255 0H80C35 0 0 35 0 80s35 80 80 80h105c22 0 40 18 40 40s-18 40-40 40H25L0 320h230c45 0 80-35 80-80s-35-80-80-80H95c-22 0-40-18-40-40s18-40 40-40h120z"
                            fill="currentColor" class="text-white" />
                        <path
                            d="M280 0h115c88 0 160 72 160 160s-72 160-160 160H245l42-80h108c44 0 80-36 80-80s-36-80-80-80H240z"
                            fill="currentColor" class="text-white/80" />
                        <rect x="289.511" y="146.602" width="42" height="42" rx="5.042" fill="currentColor"
                            class="text-white/80" />
                    </svg>
                    <span class="text-3xl font-bold leading-none sm:text-4xl" aria-hidden="true">
                        <span class="text-white">Soph</span><span class="text-white/80">Data</span>
                    </span>
                </a>

                <p
                    class="mx-auto mt-8 max-w-4xl text-3xl font-bold leading-tight text-white sm:mx-0 sm:text-4xl lg:text-5xl">
                    Tecnologia mais clara, segura e pronta para sustentar sua rotina.
                </p>

                <p class="mx-auto mt-6 max-w-2xl text-base leading-8 text-brand-100/78 sm:mx-0">
                    Da correção de falhas ao desenvolvimento de sites e sistemas, a SophData transforma demandas
                    soltas em soluções objetivas, bem explicadas e fáceis de manter.
                </p>

                <div class="mt-10 grid gap-4 sm:grid-cols-3">
                    @foreach ($footerPrinciples as $principle)
                        <div class="border-t-2 border-gold-light/70 pt-4 sm:border-l-2 sm:border-t-0 sm:pt-0 sm:pl-4">
                            <p class="text-sm font-bold text-white">{{ $principle['title'] }}</p>
                            <p class="mt-2 text-xs leading-5 text-brand-100/62">{{ $principle['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="bg-white/[0.045] p-6 text-center ring-1 ring-white/10 sm:p-7 sm:text-left"
                aria-label="Atendimento">
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-gold-light">Orientação inicial</p>
                <h2 class="mt-4 text-2xl font-bold leading-tight text-white">Conte o cenário. A SophData ajuda a
                    organizar a decisão.</h2>
                <p class="mt-4 leading-7 text-brand-100/75">
                    Você sai da conversa com mais clareza sobre urgência, caminho técnico e tipo de atendimento mais
                    adequado.
                </p>

                <div class="mt-7 grid gap-3 border-t border-white/10 pt-6 text-sm text-brand-100/80">
                    <a href="mailto:{{ config('sophdata.brand.email') }}"
                        class="break-all text-base font-semibold text-white hover:text-gold-light">
                        {{ config('sophdata.brand.email') }}
                    </a>
                    <p>{{ config('sophdata.brand.whatsapp_display') }}</p>
                    <p>{{ config('sophdata.brand.region') }}</p>
                </div>

                <x-whatsapp-link class="mx-auto mt-8 w-full justify-center sm:mx-0 sm:w-auto">Iniciar
                    atendimento</x-whatsapp-link>
            </section>
        </div>

        <nav class="mt-14 grid gap-4 sm:grid-cols-2 xl:grid-cols-4" aria-label="Principais caminhos do rodapé">
            @foreach ($primaryLinks as $link)
                <a href="{{ $link['href'] }}" @class([
                    'group relative isolate flex min-h-52 flex-col items-center justify-between gap-6 overflow-hidden rounded-xl bg-brand-950 p-5 text-center shadow-[inset_0_0_0_1px_rgba(12,36,73,0.45)] transition-shadow duration-300 hover:shadow-[inset_0_0_0_1px_rgba(12,36,73,0.55),0_20px_35px_-20px_rgba(0,0,0,0.55)] sm:items-start sm:text-left',
                ])>
                    <img src="{{ asset($link['image']) }}" alt=""
                        class="absolute inset-0 -z-20 size-full scale-[1.01] object-cover transition duration-700 ease-out group-hover:scale-105"
                        loading="lazy" decoding="async">
                    <span class="absolute -inset-px -z-10 bg-brand-950/78" aria-hidden="true"></span>
                    <span
                        class="absolute -inset-px -z-10 bg-linear-to-t from-[#071a35] via-[#0c2449]/80 to-[#0c2449]/52"
                        aria-hidden="true"></span>
                    <span @class([
                        'relative flex size-12 shrink-0 items-center justify-center rounded-xl backdrop-blur-sm transition duration-300 group-hover:scale-105',
                        'bg-gold/18 text-gold-light' => $link['tone'] === 'gold',
                        'bg-silver/18 text-silver-light' => $link['tone'] === 'silver',
                        'bg-brand-300/18 text-brand-100' => $link['tone'] === 'brand',
                    ]) aria-hidden="true">
                        <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8"
                            stroke-linecap="round" stroke-linejoin="round">
                            @foreach ($linkIconPaths[$link['icon']] as $path)
                                <path d="{{ $path }}" />
                            @endforeach
                        </svg>
                    </span>
                    <span class="mt-auto block">
                        <span
                            class="block text-lg font-bold leading-tight text-white transition duration-300 group-hover:text-gold-light">{{ $link['label'] }}</span>
                        <span
                            class="mt-3 block text-sm leading-6 text-brand-100/82 transition duration-300 group-hover:text-white/92">{{ $link['description'] }}</span>
                    </span>
                </a>
            @endforeach
        </nav>

        <div
            class="mt-9 flex flex-col items-center justify-center gap-4 border-t border-white/10 pt-6 pr-20 text-center text-xs text-brand-100/62 sm:flex-row sm:justify-between sm:text-left sm:pr-24">
            <p>© {{ date('Y') }} {{ config('sophdata.brand.name') }}. Todos os direitos reservados.</p>
            @foreach ($institutionalLinks as $link)
                <a href="{{ $link['href'] }}"
                    class="inline-flex min-h-11 items-center gap-2 rounded-full border border-white/10 px-4 py-2 text-sm font-semibold text-brand-100/78 transition hover:border-gold-light/45 hover:text-white">
                    <svg viewBox="0 0 24 24" class="size-4.5 text-silver-light" fill="none" stroke="currentColor"
                        stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        @foreach ($linkIconPaths[$link['icon']] as $path)
                            <path d="{{ $path }}" />
                        @endforeach
                    </svg>
                    {{ $link['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</footer>
