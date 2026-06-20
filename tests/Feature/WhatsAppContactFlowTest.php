<?php

test('global contact redirects to neutral whatsapp when configured', function () {
    config()->set('sophdata.contact.whatsapp_url', null);
    config()->set('sophdata.contact.whatsapp_number', '5521999999999');

    $response = $this->get('/contato')->assertRedirect();

    expect($response->headers->get('Location'))
        ->toBe('https://wa.me/5521999999999?text='.rawurlencode(config('sophdata.whatsapp_messages.neutral')));
});

test('global contact falls back to business contact when whatsapp is not configured', function () {
    config()->set('sophdata.contact.whatsapp_url', null);
    config()->set('sophdata.contact.whatsapp_number', '');
    config()->set('sophdata.brand.whatsapp', '');

    $this->get('/contato')
        ->assertRedirect('/para-empresas/contato');
});

test('business and personal pages render contextual whatsapp messages', function () {
    config()->set('sophdata.contact.whatsapp_url', null);
    config()->set('sophdata.contact.whatsapp_number', '5521999999999');

    $businessContent = $this->get('/para-empresas/contato')->assertOk()->getContent();
    $personalContent = $this->get('/para-voce/contato')->assertOk()->getContent();

    expect($businessContent)
        ->toContain('https://wa.me/5521999999999')
        ->toContain(rawurlencode(config('sophdata.whatsapp_messages.business_diagnosis')))
        ->not->toContain('href="/contato"');

    expect($personalContent)
        ->toContain('https://wa.me/5521999999999')
        ->toContain(rawurlencode(config('sophdata.whatsapp_messages.personal')))
        ->not->toContain('href="/contato"');
});

test('contact links do not generate invalid whatsapp urls when configuration is missing', function () {
    config()->set('sophdata.contact.whatsapp_url', null);
    config()->set('sophdata.contact.whatsapp_number', '');
    config()->set('sophdata.brand.whatsapp', '');

    foreach (['/para-empresas/contato', '/para-voce/contato', '/sobre'] as $path) {
        $content = $this->get($path)->assertOk()->getContent();

        expect($content)
            ->not->toContain('https://wa.me/?')
            ->not->toContain('href=""')
            ->not->toContain('href="/contato"');
    }
});
