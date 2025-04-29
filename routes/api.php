<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LRGenerateController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/lrgenerate', [LRGenerateController::class, 'index']);

Route::post('/insert_lr', [LRGenerateController::class, 'store']);