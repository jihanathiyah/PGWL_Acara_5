<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolylinesController;
use App\Http\Controllers\PolygonsController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/peta', [PageController::class, 'peta'])->name('peta');
Route::get('/tabel', [PageController::class, 'tabel'])->name('tabel');
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');

Route::post('/store-points', [PointsController::class, 'store'])->name('points.store');
Route::post('/store-polylines', [PolylinesController::class, 'store'])->name('polylines.store');
Route::post('/store-polygons', [PolygonsController::class, 'store'])->name('polygons.store');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
