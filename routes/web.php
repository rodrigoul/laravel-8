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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);

Route::middleware('auth')->prefix('items')->group(function () {
    

    Route::get('/', [App\Http\Controllers\ItemController::class, 'index'])->name('items.index');

    Route::get('/cadastrar', [App\Http\Controllers\ItemController::class, 'create'])->name('items.cadastrar');
    Route::post('/create', [App\Http\Controllers\ItemController::class, 'create'])->name('items.create');
    
    Route::get('/show/{id}', [App\Http\Controllers\ItemController::class, 'show'])->name('items.show');
    Route::post('/update/{id}', [App\Http\Controllers\ItemController::class, 'update'])->name('items.update');

});

Route::middleware('auth')->prefix('category')->group(function () {
    

    Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('category.index');

    Route::get('/cadastrar', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.cadastrar');
    Route::post('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('category.create');
    
    Route::get('/show/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
    Route::post('/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');

});



