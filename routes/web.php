<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\Gasoline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Clients;
use App\Http\Controllers\Cars;
use App\Http\Controllers\Services;
use App\Http\Controllers\Articles;
use App\Http\Controllers\Notes;

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
    return redirect('/cars');
});

# Демо доступ
Route::get('demo', DemoController::class)->name('demo.index');

# Раздел клиента
Route::group(['prefix' => 'client', 'middleware' => ['auth', 'verified']], function () {
    Route::get('', [Clients::class, 'index'])->name('client.index');
    Route::get('edit', [Clients::class, 'edit'])->name('client.edit');
    Route::put('', [Clients::class, 'update'])->name('client.update');
});

# Раздел автомобилей
Route::group(['prefix' => 'cars', 'middleware' => ['auth']], function () {

    Route::get('', [Cars::class, 'index'])->name('car.index');
    Route::get('create', [Cars::class, 'create'])->name('car.create');
    Route::post('', [Cars::class, 'store'])->name('car.store');
    Route::get('{id}', [Cars::class, 'show'])->name('car.show');
    Route::get('{id}/edit', [Cars::class, 'edit'])->name('car.edit');
    Route::put('{id}', [Cars::class, 'update'])->name('car.update');
    Route::delete('{id}', [Cars::class, 'destroy'])->name('car.destroy');
});

# Раздел обслуживания
Route::group(['prefix' => 'service', 'middleware' => ['auth']], function () {

    Route::get('', [Services::class, 'index'])->name('service.index');
    Route::get('create', [Services::class, 'create'])->name('service.create');
    Route::post('', [Services::class, 'store'])->name('service.store');
    Route::get('{id}', [Services::class, 'show'])->name('service.show');
    Route::get('{id}/edit', [Services::class, 'edit'])->name('service.edit');
    Route::put('{id}', [Services::class, 'update'])->name('service.update');
    Route::delete('{id}', [Services::class, 'destroy'])->name('service.destroy');
});

# Раздел запчастей
Route::group(['prefix' => 'articles', 'middleware' => ['auth']], function () {

    Route::get('', [Articles::class, 'index'])->name('article.index');
    Route::get('create', [Articles::class, 'create'])->name('article.create');
    Route::post('', [Articles::class, 'store'])->name('article.store');
    Route::get('{id}', [Articles::class, 'show'])->name('article.show');
    Route::get('{id}/edit', [Articles::class, 'edit'])->name('article.edit');
    Route::put('{id}', [Articles::class, 'update'])->name('article.update');
    Route::delete('{id}', [Articles::class, 'destroy'])->name('article.destroy');
});

# Раздел заправок
Route::group(['prefix' => 'gas', 'middleware' => ['auth']], function () {

    Route::get('', [Gasoline::class, 'index'])->name('gas.index');
    Route::get('create', [Gasoline::class, 'create'])->name('gas.create');
    Route::post('', [Gasoline::class, 'store'])->name('gas.store');
    Route::get('{id}', [Gasoline::class, 'show'])->name('gas.show');
    Route::get('{id}/edit', [Gasoline::class, 'edit'])->name('gas.edit');
    Route::put('{id}', [Gasoline::class, 'update'])->name('gas.update');
    Route::delete('{id}', [Gasoline::class, 'destroy'])->name('gas.destroy');
});

# Раздел заметок
Route::group(['prefix' => 'notes', 'middleware' => ['auth']], function () {

    Route::get('', [Notes::class, 'index'])->name('note.index');
    Route::get('create', [Notes::class, 'create'])->name('note.create');
    Route::post('', [Notes::class, 'store'])->name('note.store');
    Route::get('{id}', [Notes::class, 'show'])->name('note.show');
    Route::get('{id}/edit', [Notes::class, 'edit'])->name('note.edit');
    Route::put('{id}', [Notes::class, 'update'])->name('note.update');
    Route::delete('{id}', [Notes::class, 'destroy'])->name('note.destroy');
});

Auth::routes(['verify' => true]);

