<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhipuController;

Route::get('/', [KhipuController::class, 'index']);
Route::get('/bancos', [KhipuController::class, 'getBanks']);
Route::get('/crear-pago', [KhipuController::class, 'createPayment']);
Route::post('/crear-pago', [KhipuController::class, 'createPayment']);

Route::get('/estado-pago/{id}', [KhipuController::class, 'getPaymentById']);
Route::get('/estado-pago', function (Illuminate\Http\Request $request) {
    $id = $request->query('payment_id');

    if (!$id) {
        return redirect('/')->withErrors(['Debes ingresar un payment_id']);
    }

    return redirect("/estado-pago/$id");
});

Route::delete('/eliminar-pago/{id}', [KhipuController::class, 'deletePaymentById'])->name('eliminar.pago');
Route::get('/eliminar-pago', function (Illuminate\Http\Request $request) {
    $id = $request->query('payment_id');
    if (!$id) {
        return redirect('/')->withErrors(['Debes ingresar un payment_id']);
    }
    return redirect("/eliminar-pago/$id");
});





Route::get('/pago', function () {
    return view('pago'); // Este es un ejemplo simple. En tu flujo real, la vista se llama desde el controlador.
});
