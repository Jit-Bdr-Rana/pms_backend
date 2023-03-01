<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MySharesController;
use App\Http\Controllers\NepseDataController;
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

Route::get('/company', [CompanyController::class, 'getAll']);

Route::post('/role', [RoleController::class, 'store']);
Route::get('/role', [RoleController::class, 'getAll']);
Route::put('/role/{id}', [RoleController::class, 'update']);
Route::get('/role/{id}', [RoleController::class, 'getById']);
Route::delete('/role/{id}', [RoleController::class, 'delete']);


Route::post('/company', [CompanyController::class, 'store']);
Route::get('/company', [CompanyController::class, 'getAll']);
Route::get('/company/{id}', [CompanyController::class, 'getById']);
Route::put('/company/{id}', [CompanyController::class, 'update']);
Route::delete('/company/{id}', [CompanyController::class, 'delete']);
Route::post('/company/upload-csv', [CompanyController::class, 'importCsv']);

Route::post('/nepse_data', [NepseDataController::class, 'store']);
Route::get('/nepse_data', [NepseDataController::class, 'getAll']);
Route::get('/nepse_data/{id}', [NepseDataController::class, 'getById']);
Route::put('/nepse_data/{id}', [NepseDataController::class, 'update']);
Route::delete('/nepse_data/{id}', [NepseDataController::class, 'delete']);
Route::post('/nepse_data/upload-csv', [NepseDataController::class, 'importCsv']);


Route::post('/myshares', [MySharesController::class, 'store']);
Route::get('/myshares', [MySharesController::class, 'getAll']);
Route::get('/myshares', [MySharesController::class, 'getById']);
Route::put('/myshares', [MySharesController::class, 'update']);
Route::delete('/myshares', [MySharesController::class, 'delete']);


Route::post('/login', [AuthController::class, 'login']);
Route::get('/current', [AuthController::class, 'current']);
Route::get('/logout', [AuthController::class, 'logout']);