<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('/users', [\App\Http\Controllers\UserController::class, 'register']);

Route::post('/users/login', [\App\Http\Controllers\UserController::class, 'login']);

Route::middleware(\App\Http\Middleware\ApiAuthMiddleware::class)->group(function () {
    Route::get('/users/current', [\App\Http\Controllers\UserController::class, 'get']);
    Route::patch('/users/current', [\App\Http\Controllers\UserController::class, 'update']);
    Route::delete('/users/logout', [\App\Http\Controllers\UserController::class, 'logout']);

    Route::post('/roles', [\App\Http\Controllers\RoleController::class, 'create']);
    Route::get('/roles/{id}', [\App\Http\Controllers\RoleController::class, 'get'])->where('id', '[0-9]+');
    Route::put('/roles/{id}', [\App\Http\Controllers\RoleController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/roles/{id}', [\App\Http\Controllers\RoleController::class, 'delete'])->where('id', '[0-9]+');

    Route::post('/kontakamans', [\App\Http\Controllers\KontakAmanController::class, 'create']);
    Route::get('/kontakamans/{id}', [\App\Http\Controllers\KontakAmanController::class, 'get'])->where('id', '[0-9]+');
    Route::put('/kontakamans/{id}', [\App\Http\Controllers\KontakAmanController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/kontakamans/{id}', [\App\Http\Controllers\KontakAmanController::class, 'delete'])->where('id', '[0-9]+');

    Route::post('/kategorisuarapuans/{idKategori}/suarapuans', [\App\Http\Controllers\SuaraPuanController::class, 'create'])->where('idKategori', '[0-9]+');
    Route::get('/kategorisuarapuans/{idKategori}/suarapuans/{idSuaraPuan}', [\App\Http\Controllers\SuaraPuanController::class, 'get'])->where('idKategori', '[0-9]+')->where('idSuaraPuan', '[0-9]+');
    Route::put('/kategorisuarapuans/{idKategori}/suarapuans/{idSuaraPuan}', [\App\Http\Controllers\SuaraPuanController::class, 'update'])->where('idKategori', '[0-9]+')->where('idSuaraPuan', '[0-9]+');
    Route::delete('/kategorisuarapuans/{idKategori}/suarapuans/{idSuaraPuan}', [\App\Http\Controllers\SuaraPuanController::class, 'delete'])->where('idKategori', '[0-9]+')->where('idSuaraPuan', '[0-9]+');
});

Route::post('/kategoriuntukpuans', [\App\Http\Controllers\KategoriUntukPuanController::class, 'create']);
Route::get('/kategoriuntukpuans/{id}', [\App\Http\Controllers\KategoriUntukPuanController::class, 'get'])->where('id', '[0-9]+');
Route::put('/kategoriuntukpuans/{id}', [\App\Http\Controllers\KategoriUntukPuanController::class, 'update'])->where('id', '[0-9]+');
Route::delete('/kategoriuntukpuans/{id}', [\App\Http\Controllers\KategoriUntukPuanController::class, 'delete'])->where('id', '[0-9]+');

Route::post('/kategorisuarapuans', [\App\Http\Controllers\KategoriSuaraPuanController::class, 'create']);
Route::get('/kategorisuarapuans/{id}', [\App\Http\Controllers\KategoriSuaraPuanController::class, 'get'])->where('id', '[0-9]+');
Route::put('/kategorisuarapuans/{id}', [\App\Http\Controllers\KategoriSuaraPuanController::class, 'update'])->where('id', '[0-9]+');
Route::delete('/kategorisuarapuans/{id}', [\App\Http\Controllers\KategoriSuaraPuanController::class, 'delete'])->where('id', '[0-9]+');
