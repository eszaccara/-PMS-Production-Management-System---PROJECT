<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::resource('gestao-materiaprima', '\App\Http\Controllers\GestaoMPController');
Route::resource('gestao-produtos', '\App\Http\Controllers\GestaoProdutosController');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');