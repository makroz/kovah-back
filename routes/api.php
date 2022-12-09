<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', [LoginController::class, 'login'])
  ->name('login');

Route::middleware('auth:sanctum')->group(function () {
  Route::post('generate-report', [ReportController::class, 'create']);
  Route::get('get-report/{report_id}', [ReportController::class, 'show']);
  Route::get('list-reports', [ReportController::class, 'index']);
  Route::post('logout', [LoginController::class, 'logout']);
});