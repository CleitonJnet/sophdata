<?php

test('business how we work page explains the enterprise method', function () {
    $content = $this->get('/para-empresas/como-trabalhamos')
        ->assertOk()
        ->assertSee('Como Trabalhamos')
        ->assertSee('Antes da solução, vem o entendimento')
        ->assertSee('Diagnóstico')
        ->assertSee('Planejamento')
        ->assertSee('Proposta')
        ->assertSee('Execucao ou implantação')
        ->assertSee('Documentação')
        ->assertSee('Administração e evolução')
        ->assertSee('O método se adapta ao tipo de solução')
        ->assertSee('Formas de contratação')
        ->assertSee('Escopo claro evita surpresa')
        ->assertSee('Documentação para não depender de improviso')
        ->assertSee('O que precisamos da empresa atendida')
        ->assertSee('Solicitar diagnóstico empresarial')
        ->getContent();

    expect($content)
        ->toContain('/para-empresas/desenvolvimento-de-software')
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos')
        ->toContain('/para-empresas/contato')
        ->toContain('img/sophdata/cta/contact-banner.webp');
});

test('personal portal remains available after business how we work page changes', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertDontSee('O método se adapta ao tipo de solução');
});
