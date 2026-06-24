<?php

test('business contact page guides enterprise visitors to the right channel', function () {
    $content = $this->get('/para-empresas/contato')
        ->assertOk()
        ->assertSee('Contato Empresarial')
        ->assertSee('Solicite um diagnostico')
        ->assertSee('Escolha o melhor canal para falar com a SophData')
        ->assertSee('WhatsApp')
        ->assertSee(config('sophdata.brand.whatsapp_display'))
        ->assertSee('E-mail')
        ->assertSee(config('sophdata.brand.email'))
        ->assertSee('Desenvolvimento de Software')
        ->assertSee('Infraestrutura Corporativa Gerenciada')
        ->assertSee('Servidores e Ambientes Corporativos')
        ->assertSee('Planos Empresariais')
        ->assertSee('O que enviar no primeiro contato')
        ->assertSee('Como funciona o atendimento inicial')
        ->assertSee('Orientacoes importantes')
        ->getContent();

    expect($content)
        ->toContain('/para-empresas/desenvolvimento-de-software')
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos')
        ->toContain('/para-empresas/planos')
        ->toContain('https://wa.me/'.config('sophdata.brand.whatsapp'))
        ->toContain('mailto:'.config('sophdata.brand.email'));
});

test('personal portal remains available after business contact page changes', function () {
    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('Portal Para Você')
        ->assertDontSee('Contato Empresarial');
});
