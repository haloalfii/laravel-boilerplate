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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/playground', [\App\Http\Controllers\PlaygroundController::class, 'playgroundSuccess']);
    Route::get('/playground-error', [\App\Http\Controllers\PlaygroundController::class, 'playgroundError']);

//    Todo List
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
});
