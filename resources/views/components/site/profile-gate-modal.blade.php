@props([
    'background' => config('sophdata.images.banner'),
])

@php
    $backgroundUrl = asset($background);
    $businessBackgroundUrl = asset('img/sophdata/modal/profile-business.png');
    $personalBackgroundUrl = asset('img/sophdata/modal/profile-personal.png');
@endphp

<div class="fixed inset-0 z-[1200] hidden items-center justify-center px-4 py-6 sm:px-6"
    data-profile-gate
    role="dialog"
    aria-modal="true"
    aria-labelledby="profile-gate-title">
    <div class="absolute inset-0 bg-brand-950/78 backdrop-blur-sm" aria-hidden="true"></div>

    <section
        class="relative isolate max-h-[calc(100vh-3rem)] w-full max-w-4xl overflow-y-auto rounded-[1.75rem] bg-brand-950 p-6 text-white shadow-2xl ring-1 ring-white/15 sm:p-8 lg:p-10"
        style="background-image: url('{{ $backgroundUrl }}'); background-size: cover; background-position: center;">
        <span class="absolute inset-0 -z-10 bg-brand-950/86" aria-hidden="true"></span>
        <span class="absolute inset-0 -z-10 bg-linear-to-br from-[#071a35]/96 via-brand-950/88 to-brand-800/76"
            aria-hidden="true"></span>

        <div class="mx-auto max-w-2xl text-center">
            <div class="mx-auto inline-flex items-center justify-center gap-3 text-white"
                role="img"
                aria-label="SophData">
                <svg viewBox="0 0 555 320" class="h-11 w-auto shrink-0 sm:h-12" fill="none"
                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path
                        d="M255 0H80C35 0 0 35 0 80s35 80 80 80h105c22 0 40 18 40 40s-18 40-40 40H25L0 320h230c45 0 80-35 80-80s-35-80-80-80H95c-22 0-40-18-40-40s18-40 40-40h120z"
                        fill="currentColor" class="text-white" />
                    <path
                        d="M280 0h115c88 0 160 72 160 160s-72 160-160 160H245l42-80h108c44 0 80-36 80-80s-36-80-80-80H240z"
                        fill="currentColor" class="text-white/80" />
                    <rect x="289.511" y="146.602" width="42" height="42" rx="5.042" fill="currentColor"
                        class="text-gold-light/90" />
                </svg>
                <span class="text-3xl font-bold leading-none tracking-normal text-white sm:text-4xl" aria-hidden="true">
                    <span class="text-white">Soph</span><span class="text-white/78">Data</span>
                </span>
            </div>
            <h2 id="profile-gate-title" class="mt-4 text-3xl font-bold tracking-tight sm:text-4xl">
                Como podemos ajudar você hoje?
            </h2>
            <p class="mt-4 text-base leading-7 text-brand-100/82 sm:text-lg">
                Escolha o perfil de atendimento ideal para encontrar as soluções certas.
            </p>
        </div>

        <div class="mt-8 grid gap-4 sm:grid-cols-2">
            <button type="button"
                class="group relative isolate flex min-h-52 cursor-pointer flex-col justify-between overflow-hidden rounded-2xl border border-white/14 bg-brand-950 p-6 text-left shadow-xl shadow-black/10 transition hover:-translate-y-0.5 hover:border-gold-light/70 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-300"
                data-profile-choice="business"
                data-profile-url="{{ route('portal.business') }}">
                <span class="absolute -inset-1 z-0 rounded-[inherit] bg-cover bg-center"
                    style="background-image: url('{{ $businessBackgroundUrl }}');"
                    aria-hidden="true"></span>
                <span class="absolute -inset-1 z-10 rounded-[inherit] bg-brand-950/82 transition group-hover:bg-brand-950/76"
                    aria-hidden="true"></span>
                <span class="absolute -inset-1 z-10 rounded-[inherit] bg-linear-to-br from-[#071a35]/98 via-brand-950/84 to-brand-800/72"
                    aria-hidden="true"></span>
                <span class="relative z-20 grid size-12 place-items-center rounded-xl bg-gold/18 text-gold-light ring-1 ring-gold-light/25"
                    aria-hidden="true">
                    <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 21h16" />
                        <path d="M6 21V7.8c0-1 .7-1.9 1.7-2.2l5-1.7A2 2 0 0 1 15.3 5l1.7 1.1c.6.4 1 1 1 1.8V21" />
                        <path d="M9 10h.01M13 10h.01M9 14h.01M13 14h.01M9 18h.01M13 18h.01" />
                    </svg>
                </span>
                <span class="relative z-20 mt-6 block">
                    <span class="block text-2xl font-bold text-white group-hover:text-gold-light">Sou Empresa</span>
                    <span class="mt-3 block text-sm leading-6 text-brand-100/82">
                        Soluções de TI para pequenos negócios, igrejas, escolas e instituições.
                    </span>
                </span>
            </button>

            <button type="button"
                class="group relative isolate flex min-h-52 cursor-pointer flex-col justify-between overflow-hidden rounded-2xl border border-white/14 bg-brand-950 p-6 text-left shadow-xl shadow-black/10 transition hover:-translate-y-0.5 hover:border-brand-200/80 focus-visible:outline-none focus-visible:ring-4 focus-visible:ring-brand-300"
                data-profile-choice="personal"
                data-profile-url="{{ route('portal.personal') }}">
                <span class="absolute -inset-1 z-0 rounded-[inherit] bg-cover bg-center"
                    style="background-image: url('{{ $personalBackgroundUrl }}');"
                    aria-hidden="true"></span>
                <span class="absolute -inset-1 z-10 rounded-[inherit] bg-brand-950/82 transition group-hover:bg-brand-950/76"
                    aria-hidden="true"></span>
                <span class="absolute -inset-1 z-10 rounded-[inherit] bg-linear-to-br from-[#071a35]/98 via-brand-950/84 to-brand-800/72"
                    aria-hidden="true"></span>
                <span class="relative z-20 grid size-12 place-items-center rounded-xl bg-brand-300/18 text-brand-100 ring-1 ring-brand-100/25"
                    aria-hidden="true">
                    <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" />
                        <path d="M4.5 21a7.5 7.5 0 0 1 15 0" />
                    </svg>
                </span>
                <span class="relative z-20 mt-6 block">
                    <span class="block text-2xl font-bold text-white group-hover:text-brand-100">Sou Pessoa Física</span>
                    <span class="mt-3 block text-sm leading-6 text-brand-100/82">
                        Suporte, segurança digital, computador, internet, estudos e produtividade.
                    </span>
                </span>
            </button>
        </div>
    </section>
</div>
