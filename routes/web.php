<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'pages.home')->name('home');
Route::view('/para-voce', 'pages.para-voce')->name('para-voce');
Route::view('/para-empresas', 'pages.para-empresas')->name('para-empresas');
Route::view('/sobre', 'pages.sobre')->name('sobre');
Route::view('/contato', 'pages.contato')->name('contato');
Route::view('/politica-de-privacidade', 'pages.politica-de-privacidade')->name('politica-de-privacidade');
