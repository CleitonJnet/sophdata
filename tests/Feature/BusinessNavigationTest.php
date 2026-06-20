<?php

function serviceNavigationMarkup(string $content): string
{
    preg_match('/<div[^>]*data-site-service-nav[^>]*>.*?<nav[^>]*>(.*?)<\/nav>/s', $content, $matches);

    return $matches[1] ?? '';
}

test('business portal service navigation uses the new catalog menu', function (string $path) {
    $content = $this->get($path)->assertOk()->getContent();
    $navigation = serviceNavigationMarkup($content);

    expect($navigation)
        ->toContain('Desenvolvimento de Software')
        ->toContain('Infraestrutura Gerenciada')
        ->toContain('Servidores e Ambientes')
        ->toContain('Planos')
        ->toContain('Como Trabalhamos')
        ->toContain('Contato')
        ->toContain('/para-empresas/desenvolvimento-de-software')
        ->toContain('/para-empresas/infraestrutura-corporativa-gerenciada')
        ->toContain('/para-empresas/servidores-e-ambientes-corporativos')
        ->not->toContain('Sites e Sistemas')
        ->not->toContain('Suporte de TI')
        ->not->toContain('Redes e Wi-Fi')
        ->not->toContain('Segurança e Backup')
        ->not->toContain('Automação e Dados')
        ->not->toContain('Computadores Corporativos');
})->with([
    '/para-empresas',
    '/para-empresas/desenvolvimento-de-software',
    '/para-empresas/infraestrutura-corporativa-gerenciada',
    '/para-empresas/servidores-e-ambientes-corporativos',
    '/para-empresas/planos',
    '/para-empresas/como-trabalhamos',
    '/para-empresas/contato',
]);

test('personal portal service navigation keeps the personal catalog menu', function () {
    $content = $this->get('/para-voce')->assertOk()->getContent();
    $navigation = serviceNavigationMarkup($content);

    expect($navigation)
        ->toContain('Computador Lento')
        ->toContain('Wi-Fi e Casa Conectada')
        ->toContain('Contato')
        ->toContain('/para-voce/contato')
        ->not->toContain('href="/contato"')
        ->not->toContain('Desenvolvimento de Software')
        ->not->toContain('Infraestrutura Gerenciada')
        ->not->toContain('Servidores e Ambientes');
});
