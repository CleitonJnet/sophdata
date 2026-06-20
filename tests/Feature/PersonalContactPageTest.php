<?php

test('personal contact page renders the personal support flow', function () {
    $content = $this->get('/para-voce/contato')
        ->assertOk()
        ->assertSee('Contato Para Você')
        ->assertSee('Atendimento técnico para computador, notebook, internet, impressora e suporte pessoal.')
        ->assertSee('Chamar no WhatsApp')
        ->assertSee('Computador ou notebook lento')
        ->assertSee('Internet, Wi-Fi e roteador')
        ->assertSee('O que enviar no primeiro contato')
        ->assertSee('Como funciona o atendimento inicial')
        ->assertSee('Orientações importantes')
        ->assertSee('Atendimento para empresa?')
        ->assertSee('/para-empresas/contato', false)
        ->assertDontSee('<form', false)
        ->getContent();

    expect($content)
        ->toContain('https://wa.me/')
        ->toContain('rel="canonical" href="'.url('/para-voce/contato').'"')
        ->not->toContain('href="/contato"');
});

test('contact routes stay separated by profile', function () {
    $this->get('/para-empresas/contato')
        ->assertOk()
        ->assertSee('Contato Empresarial')
        ->assertDontSee('Contato Para Você');

    $response = $this->get('/contato')->assertRedirect();

    expect($response->headers->get('Location'))
        ->toStartWith('https://wa.me/')
        ->toContain(rawurlencode(config('sophdata.whatsapp_messages.neutral')));
});

test('personal navigation exposes contact without restoring global contact link', function () {
    $content = $this->get('/para-voce')->assertOk()->getContent();

    expect($content)
        ->toContain('/para-voce/contato')
        ->not->toContain('href="/contato"');
});
