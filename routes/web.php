<?php

use App\Http\Controllers\pizzariaController;
use App\Http\Controllers\adminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pizzaria', [pizzariaController::class, 'index'])->name('pizzaria.index');
Route::post('/pizzaria/pedido', [pizzariaController::class, 'store'])->name('pizzaria.store');
Route::delete('/pizzaria/{senha}', [pizzariaController::class, 'destroy'])->name('pizzaria.destroy');
Route::get('/pedido/{senha}', [pizzariaController::class, 'show'])->name('pedido.show');
Route::get('/acompanhar-pedido', [pizzariaController::class, 'acompanhar'])->name('pizzaria.acompanhar');


Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/show', [AdminController::class, 'show'])->name('admin.show');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::post('/admin/sabores', [AdminController::class, 'storeSabores'])->name('admin.storeSabores');
Route::post('/admin/tamanhos', [AdminController::class, 'storeTamanhos'])->name('admin.storeTamanhos');
Route::put('/admin/sabores/{id}', [AdminController::class, 'updateSabores'])->name('admin.updateSabores');
Route::put('/admin/tamanhos/{id}', [AdminController::class, 'updateTamanhos'])->name('admin.updateTamanhos');
Route::delete('/admin/sabores/{id}', [AdminController::class, 'destroySabores'])->name('admin.destroySabores');
Route::delete('/admin/tamanhos/{id}', [AdminController::class, 'destroyTamanhos'])->name('admin.destroyTamanhos');
Route::put('/admin/pedidos/{id}', [AdminController::class, 'updatePedidos'])->name('admin.updatePedidos');