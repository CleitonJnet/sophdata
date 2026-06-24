<?php

test('business plans page renders the enterprise plan paths', function () {
    $content = $this->get('/para-empresas/planos')
        ->assertOk()
        ->assertSee('Planos Empresariais')
        ->assertSee('Qual caminho faz mais sentido agora?')
        ->assertSee('Diagnostico e primeiros passos')
        ->assertSee('Diagnostico Digital Express')
        ->assertSee('Desenvolvimento de Software')
        ->assertSee('Presenca Digital Starter')
        ->assertSee('Infraestrutura Corporativa Gerenciada')
        ->assertSee('Infraestrutura Starter')
        ->assertSee('Servidores e Ambientes Corporativos')
        ->assertSee('Arquivos Protegidos')
        ->assertSee('Administracao mensal e continuidade')
        ->assertSee('Solicitar diagnostico empresarial')
        ->assertSee('O que normalmente nao esta incluso')
        ->assertSee('Observacoes comerciais')
        ->getContent();

    expect($content)
        ->toContain('/para-empresas/desenvolvimento-de-software')
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos')
        ->toContain('/para-empresas/contato')
        ->toContain('img/sophdata/cta/contact-banner.webp');
});

test('personal portal remains available after business plans page changes', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertDontSee('Planos Empresariais');
});
