<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LRGenerateController;
use App\Http\Controllers\InvoicesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/lr-generate', [LRGenerateController::class, 'index']);

Route::post('/insert_lr', [LRGenerateController::class, 'store']);

Route::get('/next-lr-numbers', [LRGenerateController::class, 'getNextNumbers']);

Route::get('/lr-generate/pdf/{invoice_no}', [LRGenerateController::class, 'downloadPDF']);

Route::get('/lr-details/{invoice_no}', [LRGenerateController::class, 'getLRDetailsByInvoice']);

Route::post('/calculate-net-payable', [InvoicesController::class, 'calculateNetPayable']);

Route::post('/insert_invoice', [InvoicesController::class, 'store']);
