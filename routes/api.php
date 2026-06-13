<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DiagnosticReportController;
use App\Http\Controllers\ServiceIntakeController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('diagnostics', DiagnosticReportController::class)->only(['index', 'store', 'show', 'destroy']);

Route::get('intakes', [ServiceIntakeController::class, 'index']);
Route::post('intakes', [ServiceIntakeController::class, 'store']);
Route::get('intakes/{no_nota}', [ServiceIntakeController::class, 'show']);
Route::delete('intakes/{no_nota}', [ServiceIntakeController::class, 'destroy']);
