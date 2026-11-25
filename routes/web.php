<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NacionalidadeController;

Route::resource('nacionalidades', NacionalidadeController::class)
    ->except(['show']);

Route::redirect('/', '/nacionalidades');
