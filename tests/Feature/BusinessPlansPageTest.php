<?php

test('business plans page renders the enterprise plan paths', function () {
    $content = $this->get('/para-empresas/planos')
        ->assertOk()
        ->assertSee('Planos Empresariais')
        ->assertSee('Qual caminho faz mais sentido para sua empresa?')
        ->assertSee('Diagnóstico e primeiros passos')
        ->assertSee('Diagnóstico Digital Express')
        ->assertSee('Discovery de Sistema')
        ->assertSee('Desenvolvimento de Software')
        ->assertSee('Presença Digital Starter')
        ->assertSee('Sistema Administrativo Starter')
        ->assertSee('Infraestrutura Corporativa Gerenciada')
        ->assertSee('Infraestrutura Starter')
        ->assertSee('Infraestrutura Corporativa')
        ->assertSee('Servidores e Ambientes Corporativos')
        ->assertSee('Arquivos Protegidos')
        ->assertSee('Ambiente Gerenciado')
        ->assertSee('Administração mensal e continuidade')
        ->assertSee('Servidor Gerenciado')
        ->assertSee('Solicitar diagnóstico empresarial')
        ->assertSee('O que normalmente não está incluso')
        ->assertSee('Observações comerciais')
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
