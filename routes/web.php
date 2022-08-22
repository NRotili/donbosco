<?php

use App\Http\Controllers\ClientController;
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

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Route::middleware(['auth:sanctum','verified'])->get('/dashboard',function (){
    return view('dashboard')->name('dashboard');
});

Route::get('panel', [HomeController::class, 'index']);


Route::get('client/{qr}', [ClientController::class, 'index'])->name('client');

Route::get('/migrate', function(){
    \Illuminate\Support\Facades\Artisan::call('migrate');
    dd('migrated!');
});
