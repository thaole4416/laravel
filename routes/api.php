<?php

use App\Http\Controllers\AffiliateCustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::fallback(function () {
    return response()->json([
        'message' => 'Resource not found'
    ], 404);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/connect-customer', [AffiliateCustomerController::class, 'save']);

Route::get('/connect-customer', [AffiliateCustomerController::class, 'getAll']);

// Route::get('/affiliate', 'AffiliateController@search');

// Route::get('/customer', 'CustomerController@search');