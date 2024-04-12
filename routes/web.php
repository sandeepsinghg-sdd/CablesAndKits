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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('todo', 'App\Http\Controllers\TodosController');

    Route::get('/todos', [App\Http\Controllers\TodosController::class, 'index'])->name('todo.index');
    Route::get('/todos/create', [App\Http\Controllers\TodosController::class, 'create'])->name('todo.create');
    Route::post('/todos', [App\Http\Controllers\TodosController::class, 'store'])->name('todo.store');
    Route::get('/todos/{id}/edit', [App\Http\Controllers\TodosController::class, 'edit'])->name('todo.edit');
    Route::get('/todos/show', [App\Http\Controllers\TodosController::class, 'show'])->name('todo.show');
    Route::put('/todos/{id}', [App\Http\Controllers\TodosController::class, 'update'])->name('todo.update');
    Route::delete('/todos/{id}', [App\Http\Controllers\TodosController::class, 'destroy'])->name('todo.destroy');
    Route::get('/show_decryption', [App\Http\Controllers\TodosController::class, 'show_decryption'])->name('todo.show_decryption');


