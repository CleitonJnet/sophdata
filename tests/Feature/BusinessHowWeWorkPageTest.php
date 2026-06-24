<?php

test('business how we work page explains the enterprise method', function () {
    $content = $this->get('/para-empresas/como-trabalhamos')
        ->assertOk()
        ->assertSee('Como Trabalhamos')
        ->assertSee('Antes da solucao, vem o entendimento')
        ->assertSee('Diagnostico')
        ->assertSee('Planejamento')
        ->assertSee('Proposta')
        ->assertSee('Execucao ou implantacao')
        ->assertSee('Documentacao')
        ->assertSee('Administracao e evolucao')
        ->assertSee('O metodo se adapta ao tipo de solucao')
        ->assertSee('Formas de contratacao')
        ->assertSee('Escopo claro evita surpresa')
        ->assertSee('Documentacao para nao depender de improviso')
        ->assertSee('O que precisamos da empresa atendida')
        ->assertSee('Solicitar diagnostico empresarial')
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
        ->assertDontSee('O metodo se adapta ao tipo de solucao');
});
