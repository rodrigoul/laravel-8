<?php

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
    return view('welcome');
});

Auth::routes();


Route::middleware('auth')->group(function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

    Route::get('/items', [App\Http\Controllers\ItemController::class, 'index'])->name('items.index');
    Route::get('/items/cadastrar', [App\Http\Controllers\ItemController::class, 'create'])->name('items.create');
    Route::post('/items/create', [App\Http\Controllers\ItemController::class, 'create'])->name('items.create');
    
    Route::get('/items/show/{id}', [App\Http\Controllers\ItemController::class, 'show'])->name('items.show');
    Route::post('/items/show/{id}', [App\Http\Controllers\ItemController::class, 'udpate'])->name('items.udpate');

});


