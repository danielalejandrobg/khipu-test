<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhipuController;

Route::get('/', [KhipuController::class, 'index']);
Route::get('/bancos', [KhipuController::class, 'obtenerBancos']);
Route::get('/crear-cobro', [KhipuController::class, 'crearCobro']);
