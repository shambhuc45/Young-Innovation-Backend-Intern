<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\reportgenerator;

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
Route::get('/fetch', [ReportController::class, 'fetchData']);
Route::get('/retrieve', [reportgenerator::class, 'retrieveData']);
Route::get('/total-sales', [reportgenerator::class, 'TotalSales']);
Route::get('/total-sales/country',[reportgenerator::class,'calculateSalesByCountry']);
Route::get('/total-sales/product',[reportgenerator::class,'calculateTotalSalesByProduct']);
Route::get('/total-sales/country/toplow',[reportgenerator::class,'topCountry']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
