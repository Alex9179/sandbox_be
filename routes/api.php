<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestAreasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// basic test-areas table stuff
Route::get('/test-areas', [TestAreasController::class, 'index']);
Route::post('/test-areas', [TestAreasController::class, 'store']);
Route::get('/test-areas/{id}', [TestAreasController::class, 'show']);
Route::put('/test-areas/{id}', [TestAreasController::class, 'update']);
Route::get('/test-areas/search/{area_name}', [TestAreasController::class, 'search']);
Route::delete('/test-areas/{id}', [TestAreasController::class, 'destroy']);

// GeoJSON api for test-areas
Route::get('/test-polygons', [TestAreasController::class, 'polygons']);

Route::get('/test-api', function () {
    return ['message' => 'Hello'];
});

