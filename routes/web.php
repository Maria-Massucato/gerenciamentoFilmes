<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NacionalidadeController;
use App\Http\Controllers\AtorController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\IdiomaController;
use App\Http\Controllers\FilmeController;

Route::resource('nacionalidades', NacionalidadeController::class)
    ->except(['show']);

Route::resource('atores', AtorController::class)
    ->except(['show'])
    ->parameters(['atores' => 'ator']);

Route::resource('categorias', CategoriaController::class)
    ->except(['show']);

Route::resource('idiomas', IdiomaController::class)
    ->except(['show']);

Route::resource('filmes', FilmeController::class)
    ->except(['show']);

Route::view('/', 'dashboard')->name('dashboard');
