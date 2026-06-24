<?php

test('business home renders the strengthened technical authority section', function () {
    $content = $this->get('/para-empresas')
        ->assertOk()
        ->assertSee('Responsabilidade tecnica e atendimento consultivo')
        ->assertSee('Cleiton dos Santos')
        ->assertSee('Responsavel tecnico pela SophData')
        ->assertSee('desenvolvimento de sistemas')
        ->assertSee('servidores')
        ->assertSee('redes')
        ->assertSee('Diagnostico antes da proposta')
        ->assertSee('Linguagem clara para decisao empresarial')
        ->assertSee('Falar com o responsavel tecnico')
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
        ->assertDontSee('Responsabilidade tecnica e atendimento consultivo')
        ->assertDontSee('Falar com o responsavel tecnico');
});
