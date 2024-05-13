<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', 'AuthController@login');

Route::middleware('auth:api')->group(function () {
    Route::resource('usuarios', 'UsuarioController');
    Route::resource('facturas', 'FacturaController');
});
