<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\WineController;
use App\Http\Controllers\WineryController;
use App\Http\Controllers\WinerySettingController;
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

Route::get('/wineries/{winery}/settings', [WinerySettingController::class, 'index']);
Route::get('/wineries/{winery}/wines', [WineryController::class, 'getWines']);
Route::apiResource('contact-messages', ContactMessageController::class)->only('store');
Route::apiResource('subscriptions', SubscriptionController::class)->only('store');
Route::apiResource('wineries', WineryController::class)->only('index', 'show');
Route::apiResource('wines', WineController::class)->only('index', 'show');
Route::get('/best-wines', [WineController::class, 'getBestWines']);
