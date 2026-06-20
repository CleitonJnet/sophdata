@props([
    'compact' => false,
    'authority' => null,
])

@php
    $authority = is_array($authority) ? $authority : [];
    $title = $authority['title'] ?? 'Tecnologia com experiência prática, método e responsabilidade';
    $subtitle = $authority['subtitle'] ?? null;
    $name = $authority['name'] ?? 'Cleiton dos Santos';
    $role = $authority['role'] ?? 'Engenheiro de Software';
    $image = $authority['image'] ?? 'img/profileFounderSophData.webp';
    $imageAlt = $authority['image_alt'] ?? 'Responsável técnico da SophData';
    $summary =
        $authority['summary'] ??
        'Meu compromisso é ajudar você a tomar decisões melhores sobre tecnologia, com orientação clara, diagnóstico responsável e soluções que façam sentido para a sua realidade. Antes de indicar qualquer caminho, procuro entender o problema, o contexto e o impacto que aquela solução terá na sua rotina, no seu negócio ou na sua instituição.';
    $highlights = $authority['highlights'] ?? [];
    $trustPoints = $authority['trust_points'] ?? [];
    $cta = $authority['cta'] ?? null;
    $resolvedImage = $image && (str_starts_with($image, 'http://') || str_starts_with($image, 'https://') || str_starts_with($image, '/'))
        ? $image
        : ($image ? asset($image) : null);
@endphp

<section {{ $attributes->class(['bg-white py-16 sm:py-20 lg:py-24']) }}>
    <div
        class="mx-auto grid max-w-8xl items-center gap-8 px-4 sm:px-6 lg:grid-cols-[minmax(0,22rem)_minmax(0,1fr)] lg:gap-8 lg:px-8">
        @if ($resolvedImage)
        <figure class="relative mx-auto w-full max-w-xs lg:mr-0">
            <div class="absolute inset-6 rounded-[2rem] bg-brand-200/45 blur-2xl" aria-hidden="true"></div>
            <div
                class="relative overflow-hidden rounded-[2rem] border border-brand-900/12 bg-white shadow-[0_28px_70px_-38px_rgba(7,26,53,0.55)]">
                <div class="relative bg-brand-950 p-3">
                    <div class="absolute inset-0 opacity-45 hero-grid" aria-hidden="true"></div>
                    <div class="absolute inset-x-0 top-0 h-1 bg-gold" aria-hidden="true"></div>
                    <img src="{{ $resolvedImage }}"
                        alt="{{ $imageAlt }}" width="900" height="1100"
                        class="relative aspect-4/5 w-full rounded-[1.35rem] bg-brand-950 object-cover shadow-2xl"
                        loading="lazy" decoding="async" data-founder-photo>
                    <div class="relative hidden aspect-4/5 w-full rounded-[1.35rem] bg-brand-950 p-8 text-white">
                        <x-site.logo class="text-white" />
                        <p class="mt-8 text-2xl font-bold leading-tight">Tecnologia conduzida com método e
                            responsabilidade.</p>
                    </div>
                </div>

                <figcaption class="bg-white px-6 py-4">
                    <div class="flex items-center justify-center gap-5">
                        <div class="grid size-12 shrink-0 place-items-center">
                            <img src="{{ asset(config('sophdata.logos.symbol')) }}" alt="" class="h-10 w-auto"
                                loading="lazy" decoding="async" aria-hidden="true">
                        </div>
                        <div>
                            <p class="text-xl font-bold tracking-tight text-brand-950">{{ $name }}</p>
                            <p class="text-[0.62rem] font-semibold uppercase tracking-[0.16em] text-brand-700/82">
                                {{ $role }}
                            </p>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center gap-3 border-t border-slate-200 pt-4">
                        <span class="h-px flex-1 bg-gold/70" aria-hidden="true"></span>
                        <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">SophData</p>
                    </div>
                </figcaption>
            </div>
        </figure>
        @endif

        <div>
            <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-600">Responsável técnico</p>
            @if ($title)
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-brand-950 sm:text-4xl">
                    {{ $title }}
                </h2>
            @endif
            @if ($subtitle)
                <p class="mt-4 text-lg leading-8 text-slate-600">{{ $subtitle }}</p>
            @endif
            <blockquote
                class="relative mt-6 overflow-hidden rounded-2xl border-l-4 border-gold bg-brand-50/70 px-6 py-6 pl-20">
                <span class="absolute left-5 top-2 font-serif text-8xl leading-none text-brand-300/55"
                    aria-hidden="true">“</span>
                <p class="relative text-lg leading-8 text-brand-950">
                    {{ $summary }}
                </p>
            </blockquote>

            @unless ($compact)
                @if (filled($highlights) || filled($trustPoints))
                    <div class="mt-6 flex flex-col gap-4 xl:flex-row xl:items-stretch">
                        @if (filled($highlights))
                            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:flex-[1.25]">
                                <p class="text-sm font-bold uppercase tracking-[0.16em] text-brand-600">Experiência aplicada</p>
                                <ul class="mt-4 grid gap-3 leading-7 text-slate-600">
                                    @foreach ($highlights as $highlight)
                                        <li class="flex gap-3">
                                            <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                            <span>{{ $highlight }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </article>
                        @else
                            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:flex-[1.25]">
                                <p class="text-sm font-bold uppercase tracking-[0.16em] text-brand-600">Experiência aplicada</p>
                                <p class="mt-4 leading-8 text-slate-600">
                                    São mais de 20 anos de experiência em infraestrutura de TI, redes de computadores,
                                    servidores, Linux, suporte técnico, ambientes corporativos e desenvolvimento de
                                    soluções web. Essa trajetória ajuda a enxergar o problema além do sintoma: o objetivo
                                    não é apenas corrigir uma falha, mas entender o contexto, reduzir riscos e deixar o
                                    cliente mais seguro para seguir.
                                </p>
                            </article>
                        @endif

                        @if (filled($trustPoints))
                            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:flex-[0.85]">
                                <p class="text-sm font-bold uppercase tracking-[0.16em] text-brand-600">Método e continuidade</p>
                                <ul class="mt-4 grid gap-3 leading-7 text-slate-600">
                                    @foreach ($trustPoints as $trustPoint)
                                        <li class="flex gap-3">
                                            <span class="font-bold text-brand-600" aria-hidden="true">✓</span>
                                            <span>{{ $trustPoint }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </article>
                        @else
                            <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:flex-[0.85]">
                                <p class="text-sm font-bold uppercase tracking-[0.16em] text-brand-600">Método e continuidade</p>
                                <p class="mt-4 leading-8 text-slate-600">
                                    A combinação entre Administração de Empresas e Ciência da Computação fortalece uma
                                    atuação que une visão estratégica, domínio técnico e foco em resultados. Com
                                    experiência em Linux, Java, PHP e desenvolvimento web, cada solução é construída com
                                    clareza, segurança, organização e viabilidade.
                                </p>
                            </article>
                        @endif
                    </div>
                @else
                    <div class="mt-6 flex flex-col gap-4 xl:flex-row xl:items-stretch">
                        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:flex-[1.25]">
                            <p class="text-sm font-bold uppercase tracking-[0.16em] text-brand-600">Experiência aplicada</p>
                            <p class="mt-4 leading-8 text-slate-600">
                                São mais de 20 anos de experiência em infraestrutura de TI, redes de computadores,
                                servidores, Linux, suporte técnico, ambientes corporativos e desenvolvimento de soluções
                                web. Essa trajetória ajuda a enxergar o problema além do sintoma: o objetivo não é apenas
                                corrigir uma falha, mas entender o contexto, reduzir riscos e deixar o cliente mais seguro
                                para seguir.
                            </p>
                        </article>

                        <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:flex-[0.85]">
                            <p class="text-sm font-bold uppercase tracking-[0.16em] text-brand-600">Método e continuidade</p>
                            <p class="mt-4 leading-8 text-slate-600">
                                A combinação entre Administração de Empresas e Ciência da Computação fortalece uma atuação
                                que une visão estratégica, domínio técnico e foco em resultados. Com experiência em Linux,
                                Java, PHP e desenvolvimento web, cada solução é construída com clareza, segurança,
                                organização e viabilidade.
                            </p>
                        </article>
                    </div>
                @endif

                @if (is_array($cta) && filled($cta['label'] ?? null) && filled($cta['url'] ?? null))
                    <a href="{{ $cta['url'] }}"
                        class="mt-8 inline-flex min-h-12 w-full items-center justify-center rounded-full bg-action-500 px-6 py-3 text-center text-sm font-bold text-white shadow-lg transition hover:bg-action-600 sm:w-auto">
                        {{ $cta['label'] }}
                    </a>
                @endif
            @endunless

        </div>
    </div>
</section>
