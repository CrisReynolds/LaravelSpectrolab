<?php

use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\InsumosController;
use App\Livewire\DetalleCompras;
use App\Livewire\Compras;
use App\Livewire\DetalleConsumo;
use App\Livewire\RegistrarInsumos;
use App\Livewire\ReporteCompra;
use App\Livewire\ReporteConsumo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get("gestion_usuarios", [UsuariosController::class, "index"])->name("vista_usuarios");
Route::get('/inventario', function () {
    return view('insumos.registro_insumos');
})->name('vista_insumos');
Route::get('/unidades', function () {
    return view('unidades.ver-unidades');
})->name('vista_unidades');
Route::get('/solicitantes', function () {
    return view('solicitantes.ver-solicitantes');
})->name('vista_solicitantes');
Route::get('/proveedores', function () {
    return view('proveedores.ver-proveedores');
})->name('vista_proveedores');
Route::get('/consumos', function () {
    return view('consumos.ver-consumos');
})->name('vista_consumos');
Route::get('/compras', function () {
    return view('compras.ver-compras');
})->name('vista_compras');
Route::get('/compras/{id}/detalle', [DetalleCompras::class, 'index'])->name('compras.detalle');
Route::get('/compras/reporte', [ReporteCompra::class, 'render'])->name('compras.reporte');
Route::get('/consumo/reporte', [ReporteConsumo::class, 'index'])->name('consumo.reporte');
Route::get('/export', [Compras::class, 'export'])->name('compras.export');

Route::get('/consumos/{id}/detalle', [DetalleConsumo::class, 'index'])->name('consumo.detalle');
// Route::delete("inventario/{insumo}",[InsumosController::class,"confirmarInsumoEliminacion"])->name("eliminar_insumo");
Route::delete("inventario/{insumo}", [InsumosController::class, 'desttoy'])->name('eliminar-insumo');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
