<?php

use Illuminate\Support\Facades\Route;

test('final public routes respond with the expected status codes', function () {
    $this->get('/')
        ->assertRedirect('/para-empresas');

    foreach ([
        '/para-empresas',
        '/para-voce',
        '/escolher-perfil',
        '/sobre',
        '/contato',
        '/politica-de-privacidade',
    ] as $path) {
        $this->get($path)->assertOk();
    }

    foreach (config('sophdata_services.business') as $category) {
        $this->get('/para-empresas/'.$category['slug'])->assertOk();
    }

    foreach (config('sophdata_services.personal') as $category) {
        $this->get('/para-voce/'.$category['slug'])->assertOk();
    }
});

test('portal category routing is isolated and rejects invalid slugs', function () {
    $this->get('/para-empresas/categoria-inexistente')->assertNotFound();
    $this->get('/para-voce/categoria-inexistente')->assertNotFound();

    foreach (config('sophdata_services.personal') as $category) {
        $this->get('/para-empresas/'.$category['slug'])->assertNotFound();
    }

    foreach (config('sophdata_services.business') as $category) {
        $this->get('/para-voce/'.$category['slug'])->assertNotFound();
    }
});

test('mvp does not expose login admin database migrations or functional forms', function () {
    expect(Route::has('login'))->toBeFalse()
        ->and(Route::has('register'))->toBeFalse()
        ->and(Route::has('admin'))->toBeFalse()
        ->and(file_exists(app_path('Models/User.php')))->toBeFalse()
        ->and(glob(database_path('migrations/*.php')) ?: [])->toBeEmpty();

    foreach ([
        '/para-empresas',
        '/para-voce',
        '/escolher-perfil',
        '/sobre',
        '/contato',
        '/politica-de-privacidade',
    ] as $path) {
        $content = $this->get($path)->assertOk()->getContent();

        expect($content)
            ->not->toContain('<form')
            ->not->toContain('Lorem ipsum')
            ->not->toContain('Falar no WhatsApp')
            ->not->toContain('Chamar no WhatsApp')
            ->not->toContain('Mandar WhatsApp')
            ->not->toContain('Enviar WhatsApp');
    }
});

test('portal home pages sell by customer problem and category pages sell by packages', function () {
    $this->get('/para-empresas')
        ->assertOk()
        ->assertSee('O que sua empresa precisa resolver?')
        ->assertSee('Computadores parando?')
        ->assertSee('Sua empresa não tem backup?');

    $this->get('/para-voce')
        ->assertOk()
        ->assertSee('O que você precisa resolver hoje?')
        ->assertSee('Meu computador está lento')
        ->assertSee('Preciso organizar estudos ou carreira');

    foreach ([
        '/para-empresas/suporte-de-ti',
        '/para-voce/computador-lento',
    ] as $path) {
        $this->get($path)
            ->assertOk()
            ->assertSee('Escolha o pacote ideal')
            ->assertSee('Essencial')
            ->assertSee('Profissional')
            ->assertSee('Completo')
            ->assertSee('Compare os pacotes')
            ->assertSee('<table', false)
            ->assertSee('<caption', false);
    }
});

test('sitemap and gitignore are ready for initial publication', function () {
    $sitemap = file_get_contents(public_path('sitemap.xml'));
    $gitignore = file_get_contents(base_path('.gitignore'));

    foreach ([
        'https://sophdata.com.br/',
        'https://sophdata.com.br/para-empresas',
        'https://sophdata.com.br/para-voce',
        'https://sophdata.com.br/sobre',
        'https://sophdata.com.br/contato',
        'https://sophdata.com.br/politica-de-privacidade',
    ] as $url) {
        expect($sitemap)->toContain("<loc>{$url}</loc>");
    }

    expect($gitignore)
        ->toContain('/vendor')
        ->toContain('/node_modules')
        ->toContain('.env');
});
