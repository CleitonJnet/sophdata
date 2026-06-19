@props([
    'compact' => false,
])

<section {{ $attributes->class(['bg-white py-16 sm:py-20 lg:py-24']) }}>
    <div
        class="mx-auto grid max-w-8xl items-center gap-8 px-4 sm:px-6 lg:grid-cols-[minmax(0,22rem)_minmax(0,1fr)] lg:gap-8 lg:px-8">
        <figure class="relative mx-auto w-full max-w-xs lg:mr-0">
            <div class="absolute inset-6 rounded-[2rem] bg-brand-200/45 blur-2xl" aria-hidden="true"></div>
            <div
                class="relative overflow-hidden rounded-[2rem] border border-brand-900/12 bg-white shadow-[0_28px_70px_-38px_rgba(7,26,53,0.55)]">
                <div class="relative bg-brand-950 p-3">
                    <div class="absolute inset-0 opacity-45 hero-grid" aria-hidden="true"></div>
                    <div class="absolute inset-x-0 top-0 h-1 bg-gold" aria-hidden="true"></div>
                    <img src="{{ asset('img/profileFounderSophData.webp') }}"
                        alt="Cleiton dos Santos, fundador da SophData" width="900" height="1100"
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
                            <p class="text-xl font-bold tracking-tight text-brand-950">Cleiton dos Santos</p>
                            <p class="text-[0.62rem] font-semibold uppercase tracking-[0.16em] text-brand-700/82">
                                Engenheiro de Software
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

        <div>
            <p class="text-sm font-bold uppercase tracking-[0.18em] text-brand-600">Responsável técnico</p>
            <h2 class="mt-4 text-3xl font-bold tracking-tight text-brand-950 sm:text-4xl">
                Tecnologia com experiência prática, método e responsabilidade
            </h2>
            <blockquote
                class="relative mt-6 overflow-hidden rounded-2xl border-l-4 border-gold bg-brand-50/70 px-6 py-6 pl-20">
                <span class="absolute left-5 top-2 font-serif text-8xl leading-none text-brand-300/55"
                    aria-hidden="true">“</span>
                <p class="relative text-lg leading-8 text-brand-950">
                    Meu compromisso é ajudar você a tomar decisões melhores sobre tecnologia, com orientação clara,
                    diagnóstico responsável e soluções que façam sentido para a sua realidade. Antes de indicar qualquer
                    caminho, procuro entender o problema, o contexto e o impacto que aquela solução terá na sua rotina,
                    no seu negócio ou na sua instituição.
                </p>
            </blockquote>

            @unless ($compact)
                <div class="mt-6 flex flex-col gap-4 xl:flex-row xl:items-stretch">
                    <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:flex-[1.25]">
                        <p class="text-sm font-bold uppercase tracking-[0.16em] text-brand-600">Experiência aplicada</p>
                        <p class="mt-4 leading-8 text-slate-600">
                            São mais de 20 anos de experiência em infraestrutura de TI, redes de computadores, servidores,
                            Linux, suporte técnico, ambientes corporativos e desenvolvimento de soluções web. Essa
                            trajetória ajuda a enxergar o problema além do sintoma: o objetivo não é apenas corrigir uma
                            falha, mas entender o contexto, reduzir riscos e deixar o cliente mais seguro para seguir.
                        </p>
                    </article>

                    <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm xl:flex-[0.85]">
                        <p class="text-sm font-bold uppercase tracking-[0.16em] text-brand-600">Método e continuidade</p>
                        <p class="mt-4 leading-8 text-slate-600">
                            A combinação entre Administração de Empresas e Ciência da Computação fortalece uma atuação
                            que une visão estratégica, domínio técnico e foco em resultados.
                            Com experiência em Linux, Java, PHP e desenvolvimento web, cada solução é construída com
                            clareza, segurança, organização e viabilidade.
                        </p>
                    </article>
                </div>
            @endunless

        </div>
    </div>
</section>
