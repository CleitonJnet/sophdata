@php
    $businessSolutions = array_slice(config('sophdata_services.business', []), 0, 6);
    $personalSolutions = array_slice(config('sophdata_services.personal', []), 0, 6);
@endphp

<footer class="bg-brand-950 text-white">
    <div class="mx-auto grid max-w-8xl gap-10 px-4 py-16 sm:px-6 lg:grid-cols-[1.2fr_.8fr_1fr_1fr_1fr] lg:px-8">
        <section aria-label="Resumo institucional">
            <x-site.logo light />
            <h2 class="mt-6 text-xl font-bold">SophData</h2>
            <p class="mt-3 leading-7 text-brand-100/85">{{ config('sophdata.brand.slogan') }}</p>
            <p class="mt-4 text-sm leading-6 text-brand-100/75">
                Soluções em TI para pessoas, pequenos negócios e instituições, com atendimento claro e organizado.
            </p>
            <x-whatsapp-link class="mt-6">Iniciar atendimento</x-whatsapp-link>
        </section>

        <section>
            <h2 class="font-bold">Links</h2>
            <nav class="mt-5 grid gap-1 text-sm text-brand-100/85" aria-label="Links do rodapé">
                <a href="{{ route('portal.business') }}" class="flex min-h-11 items-center hover:text-white">Para
                    Empresas</a>
                <a href="{{ route('portal.personal') }}" class="flex min-h-11 items-center hover:text-white">Para
                    Você</a>
                <a href="{{ route('portal.choose') }}" class="flex min-h-11 items-center hover:text-white">Escolher
                    perfil</a>
                <a href="{{ route('site.about') }}" class="flex min-h-11 items-center hover:text-white">Sobre</a>
                <a href="{{ route('site.contact') }}" class="flex min-h-11 items-center hover:text-white">Contato</a>
                <a href="{{ route('site.privacy') }}" class="flex min-h-11 items-center hover:text-white">Política de
                    Privacidade</a>
            </nav>
        </section>

        <section>
            <h2 class="font-bold">Soluções para empresas</h2>
            <nav class="mt-5 grid gap-1 text-sm text-brand-100/85" aria-label="Principais soluções empresariais">
                @foreach ($businessSolutions as $solution)
                    <a href="{{ route('portal.business.category', $solution['slug']) }}"
                        class="flex min-h-11 items-center hover:text-white">
                        {{ $solution['title'] }}
                    </a>
                @endforeach
            </nav>
        </section>

        <section>
            <h2 class="font-bold">Soluções para você</h2>
            <nav class="mt-5 grid gap-1 text-sm text-brand-100/85" aria-label="Principais soluções pessoais">
                @foreach ($personalSolutions as $solution)
                    <a href="{{ route('portal.personal.category', $solution['slug']) }}"
                        class="flex min-h-11 items-center hover:text-white">
                        {{ $solution['title'] }}
                    </a>
                @endforeach
            </nav>
        </section>

        <section>
            <h2 class="font-bold">Contato</h2>
            <div class="mt-5 grid gap-3 text-sm text-brand-100/85">
                <p>{{ config('sophdata.brand.whatsapp_display') }}</p>
                <a href="mailto:{{ config('sophdata.brand.email') }}"
                    class="break-all hover:text-white">{{ config('sophdata.brand.email') }}</a>
                <p>{{ config('sophdata.brand.region') }}</p>
                <p>Atendimento remoto e presencial sob consulta.</p>
            </div>
        </section>
    </div>

    <div class="border-t border-white/10">
        <div
            class="mx-auto flex max-w-8xl flex-col gap-3 px-4 py-6 pr-20 text-xs text-brand-100/75 sm:flex-row sm:items-center sm:justify-between sm:px-6 sm:pr-24 lg:px-8">
            <p>© {{ date('Y') }} {{ config('sophdata.brand.name') }}. Todos os direitos reservados.</p>
            <a href="{{ route('site.privacy') }}" class="hover:text-white">Política de Privacidade</a>
        </div>
    </div>
</footer>
