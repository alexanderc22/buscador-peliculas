<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\FavoriteController;

//Route::get('/movies/search', [MovieController::class, 'search']);
//Route::get('/movies/{imdbId}', [MovieController::class, 'show']);

// Búsqueda de películas /api/movies/search?q=batman&year=2005
Route::get('/movies/search', [MovieController::class, 'searchApi']);

// Ver detalle de película por ID IMDB /api/movies/tt0372784
Route::get('/movies/{id}', [MovieController::class, 'show']);

// protegidas solo para usuarios logueados
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me/favorites', [FavoriteController::class, 'index']);
    Route::post('/favorites', [FavoriteController::class, 'store']);
    Route::delete('/favorites/{imdb_id}', [FavoriteController::class, 'destroy']);
});