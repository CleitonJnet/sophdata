<?php

test('non indexable environment renders noindex robots meta and absolute canonical', function () {
    $content = $this->get('/para-empresas')->assertOk()->getContent();

    expect($content)
        ->toContain('name="robots" content="noindex, nofollow"')
        ->toContain('rel="canonical" href="'.url('/para-empresas').'"')
        ->toContain('property="og:url" content="'.url('/para-empresas').'"')
        ->toContain('name="twitter:card" content="summary_large_image"');
});

test('business category exposes seo fallback with canonical and og image', function () {
    $content = $this->get('/para-empresas/desenvolvimento-de-software/sistemas-sob-medida')
        ->assertOk()
        ->getContent();

    expect($content)
        ->toContain('<title>Sistemas Sob Medida | Desenvolvimento de Software SophData</title>')
        ->toContain('rel="canonical" href="'.url('/para-empresas/desenvolvimento-de-software/sistemas-sob-medida').'"')
        ->toContain('property="og:image"')
        ->toContain('name="robots" content="noindex, nofollow"');
});

test('robots and sitemap static files match the non indexable provisional strategy', function () {
    $robots = file_get_contents(public_path('robots.txt'));
    $sitemap = file_get_contents(public_path('sitemap.xml'));

    expect($robots)
        ->toContain('User-agent: *')
        ->toContain('Disallow: /')
        ->not->toContain('Sitemap:');

    expect($sitemap)
        ->toContain(config('app.url').'/para-empresas')
        ->toContain(config('app.url').'/para-voce')
        ->not->toContain('https://sophdata.com.br');
});
