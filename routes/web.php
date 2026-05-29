<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PointsController;
use App\Http\Controllers\PolygonsController;
use App\Http\Controllers\PolylinesController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//    return view('welcome');
// })->name('home');

Route::get('/', [PageController::class, 'landingpage'])->name('home');

// Halaman Peta
Route::get('/peta', [PageController::class, 'peta'])
->middleware(['auth', 'verified'])
->name('peta');

// Halaman Tabel
Route::get('/tabel', [PageController::class, 'tabel'])->name('tabel');

// Halaman Tentang
Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');


// ================= POINTS =================

// Simpan point
Route::post('/store-points', [PointsController::class, 'store'])
    ->name('points.store');

// Hapus point
Route::delete('/delete-point/{id}', [PointsController::class, 'destroy'])
    ->name('points.delete');

// Edit point
Route::get('/edit-point/{id}', [PointsController::class, 'edit'])
    ->name('points.edit');

// Update point
Route::patch('/update-point/{id}', [PointsController::class, 'update'])
    ->name('points.update');


// ================= POLYLINES =================

// Simpan polyline
Route::post('/store-polylines', [PolylinesController::class, 'store'])
    ->name('polylines.store');

// Hapus polyline
Route::delete('/delete-polyline/{id}', [PolylinesController::class, 'destroy'])
    ->name('polylines.delete');

// Edit polyline
Route::get('/edit-polyline/{id}', [PolylinesController::class, 'edit'])
    ->name('polylines.edit');

// Update polyline
Route::patch('/update-polyline/{id}', [PolylinesController::class, 'update'])
    ->name('polylines.update');


// ================= POLYGONS =================

// Simpan polygon
Route::post('/store-polygons', [PolygonsController::class, 'store'])
    ->name('polygons.store');

// Hapus polygon
Route::delete('/delete-polygon/{id}', [PolygonsController::class, 'destroy'])
    ->name('polygons.delete');

// Edit polygon
Route::get('/edit-polygon/{id}', [PolygonsController::class, 'edit'])
    ->name('polygons.edit');

// Update polygon
Route::patch('/update-polygon/{id}', [PolygonsController::class, 'update'])
    ->name('polygons.update');


// ================= DASHBOARD =================

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__.'/settings.php';
