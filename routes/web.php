<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CocinaController;
use App\Http\Controllers\GastosController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuitemController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('home');
}); 

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/reportar/create', [HomeController::class, 'create'])->name('reportes.create');
Route::get('/reportar/get', [HomeController::class, 'get'])->name('reportar.get');
Route::get('/reportar', [HomeController::class, 'reportar'])->name('reportar');
Route::get('/reportasCliente', [HomeController::class, 'vieadmin'])->name('reportar.vieadmin');

Route::get('/reportrepartidor', [HomeController::class, 'reportrepartidor'])->name('reportar.reportrepartidor');

Route::get('/ausuario', [UsuarioController::class, 'index'])->name('usuario');
Route::post('/ausuario/create', [UsuarioController::class, 'store'])->name('usuario.create');
Route::get('/ausuario/{id}', [UsuarioController::class, 'destroy'])->name('usuario.delete');
Route::get('/prestamos', [UsuarioController::class, 'prestamos'])->name('prestamos');
Route::post('/prestamos/update', [UsuarioController::class, 'update'])->name('usuario.update');

Route::get('/mesa', [MesaController::class, 'index'])->name('mesa');
Route::post('/mesa/create', [MesaController::class, 'store'])->name('mesa.create');
Route::get('/mesa/{id}', [MesaController::class, 'destroy'])->name('mesa.delete');

Route::get('/cliente', [ClienteController::class, 'index'])->name('cliente');
Route::post('/cliente/create', [ClienteController::class, 'store'])->name('cliente.create'); 
Route::get('/cliente/{id}', [ClienteController::class, 'destroy'])->name('cliente.delete');
Route::get('/deudas', [ClienteController::class, 'deudas'])->name('cliente.deudas');
Route::post('/deudas/update', [ClienteController::class, 'update'])->name('cliente.update');
 

Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::post('/menu/create', [MenuController::class, 'store'])->name('menu.create');
Route::get('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.delete');

Route::get('/menuitem', [MenuitemController::class, 'index'])->name('menuitem');
Route::post('/menuitem/create', [MenuitemController::class, 'store'])->name('menuitem.create');
Route::get('/menuitem/{id}', [MenuitemController::class, 'destroy'])->name('menuitem.delete');

Route::get('/listmesas', [OrdenController::class, 'index'])->name('listmesas');
Route::get('/orden', [OrdenController::class, 'orden'])->name('orden');
Route::get('/ordenedit', [OrdenController::class, 'ordenedit'])->name('ordenedit');
Route::post('/orden/create', [OrdenController::class, 'store'])->name('orden.create'); 
Route::get('/orden/{id}', [OrdenController::class, 'destroy'])->name('orden.delete');

Route::get('/gastos', [GastosController::class, 'index'])->name('gastos');
Route::post('/gastos/create', [GastosController::class, 'store'])->name('gastos.create');
Route::get('/gastos/{id}', [GastosController::class, 'destroy'])->name('gastos.delete');

Route::get('/venta/create', [VentaController::class, 'create'])->name('venta.create');
Route::post('/venta/update', [VentaController::class, 'update'])->name('venta.update');
Route::get('/ventas/updated', [VentaController::class, 'updated'])->name('venta.updated');
Route::get('/ventas/edit', [VentaController::class, 'edit'])->name('venta.edit');
Route::get('/cocina', [CocinaController::class, 'index'])->name('cocina'); 

Route::get('/cocinap/{id}', [CocinaController::class, 'cPreparando'])->name('cocina.preparando');
Route::get('/cocinal/{id}', [CocinaController::class, 'cListo'])->name('cocina.listo');
Route::get('/cocinac/{id}', [CocinaController::class, 'cCancelar'])->name('cocina.cancelar');


Route::get('/preparando', [OrdenController::class, 'preparando'])->name('preparando');
Route::get('/listo', [OrdenController::class, 'listo'])->name('listo');
Route::get('/listo/list', [OrdenController::class, 'listListo'])->name('listo.list');
Route::get('/preparando/list', [OrdenController::class, 'listPreparando'])->name('preparando.list');






