<?php

use App\Http\Controllers\PortalController;
use App\Http\Controllers\BusinessCatalogController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => null)
    ->middleware('default.portal');

Route::get('/para-empresas', [PortalController::class, 'business'])
    ->name('portal.business');
Route::get('/para-empresas/desenvolvimento-de-software', [BusinessCatalogController::class, 'softwareIndex'])
    ->name('business.software.index');
Route::get('/para-empresas/desenvolvimento-de-software/{category}', [BusinessCatalogController::class, 'softwareCategory'])
    ->name('business.software.category');
Route::get('/para-empresas/infraestrutura-corporativa-gerenciada', [BusinessCatalogController::class, 'infrastructureIndex'])
    ->name('business.infrastructure.index');
Route::get('/para-empresas/infraestrutura-corporativa-gerenciada/{category}', [BusinessCatalogController::class, 'infrastructureCategory'])
    ->name('business.infrastructure.category');
Route::get('/para-empresas/servidores-e-ambientes-corporativos', [BusinessCatalogController::class, 'serversIndex'])
    ->name('business.servers.index');
Route::get('/para-empresas/servidores-e-ambientes-corporativos/{category}', [BusinessCatalogController::class, 'serversCategory'])
    ->name('business.servers.category');
Route::get('/para-empresas/planos', [BusinessCatalogController::class, 'plans'])
    ->name('business.plans');
Route::get('/para-empresas/como-trabalhamos', [BusinessCatalogController::class, 'howWeWork'])
    ->name('business.how');
Route::get('/para-empresas/contato', [BusinessCatalogController::class, 'contact'])
    ->name('business.contact');

// Redirecionamentos das categorias empresariais antigas para a nova arquitetura do catalogo.
Route::redirect('/para-empresas/sites-e-sistemas', '/para-empresas/desenvolvimento-de-software', 301);
Route::redirect('/para-empresas/automacao-e-dados', '/para-empresas/desenvolvimento-de-software/automacoes-e-integracoes', 301);
Route::redirect('/para-empresas/suporte-de-ti', '/para-empresas/infraestrutura-corporativa-gerenciada/administracao-mensal', 301);
Route::redirect('/para-empresas/redes-e-wifi', '/para-empresas/infraestrutura-corporativa-gerenciada/redes-corporativas', 301);
Route::redirect('/para-empresas/seguranca-e-backup', '/para-empresas/servidores-e-ambientes-corporativos/backup-empresarial', 301);
Route::redirect('/para-empresas/computadores-corporativos', '/para-empresas/infraestrutura-corporativa-gerenciada/hardware-corporativo', 301);

Route::get('/para-empresas/{category}', [ServiceCategoryController::class, 'business'])
    ->name('portal.business.category');

Route::get('/para-voce', [PortalController::class, 'personal'])
    ->name('portal.personal');
Route::get('/para-voce/contato', [PortalController::class, 'personalContact'])
    ->name('personal.contact');
Route::get('/para-voce/{category}', [ServiceCategoryController::class, 'personal'])
    ->name('portal.personal.category');

Route::get('/escolher-perfil', [PortalController::class, 'choose'])
    ->name('portal.choose');

Route::get('/sobre', [StaticPageController::class, 'about'])
    ->name('site.about');
Route::get('/contato', function () {
    $whatsappUrl = sophdata_whatsapp_url(config('sophdata.whatsapp_messages.neutral'));

    return $whatsappUrl
        ? redirect()->away($whatsappUrl)
        : redirect('/para-empresas/contato');
});
Route::get('/politica-de-privacidade', [StaticPageController::class, 'privacy'])
    ->name('site.privacy');
