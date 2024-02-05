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

    Route::post('/questions', [\App\Http\Controllers\QuestionController::class, 'create']);
    Route::get('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'get'])->where('id', '[0-9]+');
    Route::put('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/questions/{id}', [\App\Http\Controllers\QuestionController::class, 'delete'])->where('id', '[0-9]+');

    Route::post('/suarapuans', [\App\Http\Controllers\SuaraPuanController::class, 'create']);
    Route::get('/suarapuans/{id}', [\App\Http\Controllers\SuaraPuanController::class, 'get'])->where('id', '[0-9]+');
    Route::put('/suarapuans/{id}', [\App\Http\Controllers\SuaraPuanController::class, 'update'])->where('id', '[0-9]+');
    Route::delete('/suarapuans/{id}', [\App\Http\Controllers\SuaraPuanController::class, 'delete'])->where('id', '[0-9]+');

    Route::post('/suarapuans/{idSuaraPuan}/commentpuans', [\App\Http\Controllers\CommentController::class, 'create'])->where('idsuarapuan', '[0-9]+');
    Route::get('/suarapuans/{idSuaraPuan}/commentpuans/{idComment}', [\App\Http\Controllers\CommentController::class, 'get'])->where('idsuarapuan', '[0-9]+')->where('idCommentPuan', '[0-9]+');
    Route::put('/suarapuans/{idSuaraPuan}/commentpuans/{idComment}', [\App\Http\Controllers\CommentController::class, 'update'])->where('idsuarapuan', '[0-9]+')->where('idCommentPuan', '[0-9]+');
    Route::delete('/suarapuans/{idSuaraPuan}/commentpuans/{idComment}', [\App\Http\Controllers\CommentController::class, 'delete'])->where('idsuarapuan', '[0-9]+')->where('idCommentPuan', '[0-9]+');

    Route::post('/questions/{idQuestion}/options', [\App\Http\Controllers\OptionController::class, 'create'])->where('idquestion', '[0-9]+');
    Route::get('/questions/{idQuestion}/options/{idOption}', [\App\Http\Controllers\OptionController::class, 'get'])->where('idquestion', '[0-9]+')->where('idoption', '[0-9]+');
    Route::put('/questions/{idQuestion}/options/{idOption}', [\App\Http\Controllers\OptionController::class, 'update'])->where('idquestion', '[0-9]+')->where('idoption', '[0-9]+');
    Route::delete('/questions/{idQuestion}/options/{idOption}', [\App\Http\Controllers\OptionController::class, 'delete'])->where('idquestion', '[0-9]+')->where('idoption', '[0-9]+');

    Route::post('/catatanhaids', [\App\Http\Controllers\CatatanHaidController::class, 'create']);
    Route::get('/catatanhaids/{iduser}', [\App\Http\Controllers\CatatanHaidController::class, 'get'])->where('iduser', '[0-9]+');
    Route::put('/catatanhaids/{iduser}', [\App\Http\Controllers\CatatanHaidController::class, 'update'])->where('iduser', '[0-9]+');
    Route::delete('/catatanhaids/{iduser}', [\App\Http\Controllers\CatatanHaidController::class, 'delete'])->where('iduser', '[0-9]+');
});

Route::post('/kategoriuntukpuans', [\App\Http\Controllers\KategoriUntukPuanController::class, 'create']);
Route::get('/kategoriuntukpuans/{id}', [\App\Http\Controllers\KategoriUntukPuanController::class, 'get'])->where('id', '[0-9]+');
Route::put('/kategoriuntukpuans/{id}', [\App\Http\Controllers\KategoriUntukPuanController::class, 'update'])->where('id', '[0-9]+');
Route::delete('/kategoriuntukpuans/{id}', [\App\Http\Controllers\KategoriUntukPuanController::class, 'delete'])->where('id', '[0-9]+');

Route::post('/kategorisuarapuans', [\App\Http\Controllers\KategoriSuaraPuanController::class, 'create']);
Route::get('/kategorisuarapuans/{id}', [\App\Http\Controllers\KategoriSuaraPuanController::class, 'get'])->where('id', '[0-9]+');
Route::put('/kategorisuarapuans/{id}', [\App\Http\Controllers\KategoriSuaraPuanController::class, 'update'])->where('id', '[0-9]+');
Route::delete('/kategorisuarapuans/{id}', [\App\Http\Controllers\KategoriSuaraPuanController::class, 'delete'])->where('id', '[0-9]+');
