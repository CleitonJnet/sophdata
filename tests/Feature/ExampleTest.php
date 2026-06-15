<?php

use Illuminate\Support\Facades\Route;

test('all public pages render with the shared site structure', function (string $routeName) {
    $response = $this->get(route($routeName));

    $response->assertOk()
        ->assertSee('<meta name="description"', false)
        ->assertSee('SophData')
        ->assertSee('Para Você')
        ->assertSee('Para Empresas')
        ->assertSee('Soluções em TI para pessoas e empresas')
        ->assertSee('Suporte Digital Pessoal')
        ->assertSee('Montagem e Renovação de Computadores Corporativos')
        ->assertSee('5521972765535')
        ->assertSee('Falar com a SophData no WhatsApp')
        ->assertSee('Todos os direitos reservados');

    expect(Route::has($routeName))->toBeTrue();
})->with([
    'home',
    'para-voce',
    'para-empresas',
    'sobre',
    'contato',
    'politica-de-privacidade',
]);

test('header exposes profile mega menus and category destinations', function () {
    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertSee('data-mega-menu', false)
        ->assertSee('aria-controls="mega-menu-personal"', false)
        ->assertSee('aria-controls="mega-menu-business"', false)
        ->assertSee(route('para-voce').'#suporte-digital-pessoal', false)
        ->assertSee(route('para-empresas').'#seguranca-e-backup', false)
        ->assertSee('>SD<', false);
});

test('public pages expose unique seo metadata and an accessible document structure', function (
    string $routeName,
    string $title,
    string $description,
) {
    $response = $this->get(route($routeName));
    $content = $response->getContent();

    $response->assertOk()
        ->assertSee("<title>{$title}</title>", false)
        ->assertSee('name="description" content="'.$description.'"', false)
        ->assertSee('name="robots" content="index, follow"', false)
        ->assertSee('<link rel="canonical"', false)
        ->assertSee('href="#conteudo-principal"', false)
        ->assertSee('id="conteudo-principal"', false);

    expect(preg_match_all('/<h1\b/i', $content))->toBe(1)
        ->and(preg_match_all('/<h2\b/i', $content))->toBeGreaterThan(0);

    preg_match_all('/<img\b[^>]*>/i', $content, $images);

    foreach ($images[0] as $image) {
        expect($image)->toMatch('/\balt="[^"]+"/i');
    }
})->with([
    'home' => [
        'home',
        'SophData | Soluções em TI para pessoas e empresas',
        'Suporte técnico, segurança digital, sites, sistemas, redes, backup, automação e montagem de computadores para pessoas e pequenos negócios.',
    ],
    'para você' => [
        'para-voce',
        'Para Você | SophData',
        'Suporte para computador, internet, segurança digital, estudos, produtividade e montagem de computadores para pessoas físicas.',
    ],
    'para empresas' => [
        'para-empresas',
        'Para Empresas | SophData',
        'Suporte de TI, redes, segurança, sites, sistemas, automação e consultoria para pequenos negócios e instituições.',
    ],
    'sobre' => [
        'sobre',
        'Sobre | SophData',
        'Conheça a SophData, uma marca de soluções em TI com foco em clareza, organização, confiança e atendimento prático.',
    ],
    'contato' => [
        'contato',
        'Contato | SophData',
        'Fale com a SophData pelo WhatsApp e solicite atendimento ou orçamento para soluções em TI.',
    ],
    'política de privacidade' => [
        'politica-de-privacidade',
        'Política de Privacidade | SophData',
        'Informações sobre privacidade e uso de dados no site institucional da SophData.',
    ],
]);

test('robots and sitemap publish every public page using the provisional domain', function () {
    $robots = file_get_contents(public_path('robots.txt'));
    $sitemap = file_get_contents(public_path('sitemap.xml'));
    $urls = [
        'https://sophdata.com.br/',
        'https://sophdata.com.br/para-voce',
        'https://sophdata.com.br/para-empresas',
        'https://sophdata.com.br/sobre',
        'https://sophdata.com.br/contato',
        'https://sophdata.com.br/politica-de-privacidade',
    ];

    expect($robots)
        ->toContain("User-agent: *\nAllow: /")
        ->toContain('Sitemap: https://sophdata.com.br/sitemap.xml')
        ->and($sitemap)
        ->toContain('Domínio provisório')
        ->toContain('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">');

    foreach ($urls as $url) {
        expect($sitemap)->toContain("<loc>{$url}</loc>");
    }

    expect(substr_count($sitemap, '<url>'))->toBe(6);
});

test('mvp has no authentication database admin panel functional form or prices', function () {
    $publicRoutes = collect(app('router')->getRoutes()->getRoutes())
        ->reject(fn ($route) => str_starts_with($route->uri(), '_'))
        ->reject(fn ($route) => in_array($route->uri(), ['up', 'storage/{path}'], true));

    expect($publicRoutes)->toHaveCount(6)
        ->and($publicRoutes->pluck('uri')->all())->toBe([
            '/',
            'para-voce',
            'para-empresas',
            'sobre',
            'contato',
            'politica-de-privacidade',
        ])
        ->and(file_exists(app_path('Models/User.php')))->toBeFalse()
        ->and(file_exists(base_path('routes/settings.php')))->toBeFalse()
        ->and(file_exists(database_path('database.sqlite')))->toBeFalse()
        ->and(glob(database_path('migrations/*.php')) ?: [])->toBeEmpty();

    $composer = file_get_contents(base_path('composer.json'));

    expect($composer)
        ->not->toContain('laravel/fortify')
        ->not->toContain('livewire/livewire')
        ->not->toContain('livewire/flux');

    foreach (['home', 'para-voce', 'para-empresas', 'sobre', 'contato', 'politica-de-privacidade'] as $routeName) {
        $content = $this->get(route($routeName))->assertOk()->getContent();

        expect($content)
            ->not->toContain('<form')
            ->not->toMatch('/(?:R\\$|\\$\\s*\\d|\\bpreço\\b)/iu');
    }
});
