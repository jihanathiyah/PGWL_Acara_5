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

// Points
Route::post('/store-points', [PointsController::class, 'store'])->name('points.store');

// Route untuk menghapus point berdasarkan ID
Route::delete('/delete-points/{id}', [PointsController::class, 'destroy'])->name('points.delete');

// Polylines
Route::post('/store-polylines', [PolylinesController::class, 'store'])->name('polylines.store');

// Route untuk menghapus polyline berdasarkan ID
Route::delete('/delete-polylines/{id}', [PolylinesController::class, 'destroy'])->name('polylines.delete');

// Polygons
Route::post('/store-polygons', [PolygonsController::class, 'store'])->name('polygons.store');

// Route untuk menghapus polygon berdasarkan ID
Route::delete('/delete-polygons/{id}', [PolygonsController::class, 'destroy'])->name('polygons.delete');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
