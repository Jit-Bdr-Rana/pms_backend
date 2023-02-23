<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoleController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/company',[CompanyController::class,'getAll']);

Route::post('/role',[RoleController::class,'store']);
Route::get('/role',[RoleController::class,'getAll']);
Route::put('/role/{id}',[RoleController::class,'update']);
Route::get('/role/{id}',[RoleController::class,'getById']);
Route::delete('/role/{id}',[RoleController::class,'delete']);


Route::post('/company',[CompanyController::class,'store']);
Route::get('/company',[CompanyController::class,'getAll']);
Route::get('/company/{id}',[CompanyController::class,'getById']);
Route::put('/company/{id}',[CompanyController::class,'update']);
Route::delete('/company/{id}',[CompanyController::class,'delete']);
