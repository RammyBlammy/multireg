<?php

use App\Http\Controllers\CityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Middleware\RedirectToCity;

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

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/{name}', [MainController::class, 'redirectToCity'])->name('set.city');

// Группируем маршруты по slug города
Route::group(['prefix' => '{city}'], function () {
    Route::get('/', [MainController::class, 'index'])->name('index.city');
    Route::get('/about', [MainController::class, 'about'])->name('about');
    Route::get('/news', [MainController::class, 'news'])->name('news');
})->middleware(RedirectToCity::class);

// Группируем маршруты для управления городами
Route::prefix('cities')->group(function () {
    Route::post('/', [CityController::class, 'add']); // Добавление города
    Route::delete('/{id}', [CityController::class, 'delete']); // Удаление города
});
