<?php

use App\Http\Controllers\PortalController;
use App\Http\Controllers\ServiceCategoryController;
use App\Http\Controllers\StaticPageController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => null)
    ->middleware('default.portal');

Route::get('/para-empresas', [PortalController::class, 'business'])
    ->name('portal.business');
Route::get('/para-empresas/{category}', [ServiceCategoryController::class, 'business'])
    ->name('portal.business.category');

Route::get('/para-voce', [PortalController::class, 'personal'])
    ->name('portal.personal');
Route::get('/para-voce/{category}', [ServiceCategoryController::class, 'personal'])
    ->name('portal.personal.category');

Route::get('/escolher-perfil', [PortalController::class, 'choose'])
    ->name('portal.choose');

Route::get('/sobre', [StaticPageController::class, 'about'])
    ->name('site.about');
Route::get('/contato', [StaticPageController::class, 'contact'])
    ->name('site.contact');
Route::get('/politica-de-privacidade', [StaticPageController::class, 'privacy'])
    ->name('site.privacy');
