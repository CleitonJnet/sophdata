<?php

use App\Http\Middleware\RedirectToDefaultPortal;
use Illuminate\Support\Facades\Route;

test('root redirects to the default business portal through middleware', function () {
    $this->get('/')
        ->assertRedirect(route('portal.business'));

    expect(app('router')->getMiddleware()['default.portal'])
        ->toBe(RedirectToDefaultPortal::class);
});

test('public routes keep portuguese slugs and english internal names', function () {
    $expectedRoutes = [
        'portal.business' => 'para-empresas',
        'portal.business.category' => 'para-empresas/{category}',
        'portal.personal' => 'para-voce',
        'portal.personal.category' => 'para-voce/{category}',
        'portal.choose' => 'escolher-perfil',
        'site.about' => 'sobre',
        'site.contact' => 'contato',
        'site.privacy' => 'politica-de-privacidade',
    ];

    foreach ($expectedRoutes as $name => $uri) {
        expect(Route::has($name))->toBeTrue()
            ->and(Route::getRoutes()->getByName($name)?->uri())->toBe($uri);
    }
});

test('mvp remains static without authentication database admin or forms', function () {
    expect(file_exists(app_path('Models/User.php')))->toBeFalse()
        ->and(file_exists(database_path('database.sqlite')))->toBeFalse()
        ->and(glob(database_path('migrations/*.php')) ?: [])->toBeEmpty();

    foreach ([
        'portal.business',
        'portal.personal',
        'portal.choose',
        'site.about',
        'site.contact',
        'site.privacy',
    ] as $routeName) {
        $content = $this->get(route($routeName))->assertOk()->getContent();

        expect($content)
            ->not->toContain('<form')
            ->not->toContain('Falar no WhatsApp')
            ->not->toContain('Chamar no WhatsApp')
            ->not->toContain('Mandar WhatsApp');
    }
});
