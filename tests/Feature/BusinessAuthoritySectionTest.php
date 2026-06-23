<?php

test('business home renders the strengthened technical authority section', function () {
    $content = $this->get('/para-empresas')
        ->assertOk()
        ->assertSee('Responsabilidade técnica e atendimento consultivo')
        ->assertSee('Cleiton Araújo')
        ->assertSee('Responsável técnico pela SophData')
        ->assertSee('desenvolvimento de sistemas')
        ->assertSee('servidores')
        ->assertSee('redes')
        ->assertSee('Atuação com desenvolvimento web e sistemas sob medida')
        ->assertSee('Vivência com Linux, redes, servidores e ambientes corporativos')
        ->assertSee('Diagnóstico antes da proposta')
        ->assertSee('Linguagem clara para decisão empresarial')
        ->assertSee('Falar com o responsável técnico')
        ->getContent();

    expect($content)
        ->toContain('img/profileFounderSophData.webp')
        ->toContain('/para-empresas/contato');
});

test('personal portal remains available with the shared authority component fallback', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertSee('Responsável técnico')
        ->assertDontSee('Responsabilidade técnica e atendimento consultivo')
        ->assertDontSee('Falar com o responsável técnico');
});
