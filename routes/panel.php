<?php

use App\Http\Controllers\Panel\Administracion\Categorias\CategoriaController;
use App\Http\Controllers\Panel\Administracion\Clientes\ClientController;
use App\Http\Controllers\Panel\Administracion\Finanzas\FinanzaController;
use App\Http\Controllers\Panel\Administracion\Productos\ProductoController;
use App\Http\Controllers\Panel\Administracion\Ventas\SalesController;
use App\Http\Controllers\Panel\Configuracion\RoleController;
use App\Http\Controllers\Panel\Configuracion\Sistema\ConfigController;
use App\Http\Controllers\Panel\Configuracion\UserController;
use App\Http\Controllers\Panel\HomeController;
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

Route::get('/',[HomeController::class, 'index'])->name('panel.home');

Route::resource('administracion/clientes', ClientController::class)->names('panel.administracion.clientes');
Route::resource('administracion/ventas', SalesController::class)->names('panel.administracion.ventas');
Route::resource('administracion/productos', ProductoController::class)->names('panel.administracion.productos');
Route::resource('administracion/categorias', CategoriaController::class)->names('panel.administracion.categorias');

Route::resource('configuracion/sistema', ConfigController::class)->names('panel.configuraciones.sistema');

Route::resource('configuracion/users', UserController::class)->names('panel.configuracion.users');
Route::resource('configuracion/roles', RoleController::class)->names('panel.configuracion.roles');

Route::get('administracion/clientes/{id}/plus',[ClientController::class, 'plus'])->name('panel.administracion.clientes.plus');
Route::put('administracion/clientes/plusupdate/{cliente}',[ClientController::class, 'plusupdate'])->name('panel.administracion.clientes.plusupdate');

Route::get('administracion/finanzas', [FinanzaController::class, 'index'])->name('panel.administracion.finanzas.index');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



