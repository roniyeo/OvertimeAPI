<?php

use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\OvertimeController;
use App\Http\Controllers\API\SettingController;
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
// PATCH /settings
Route::patch('/settings', [SettingController::class, 'update']);

// POST /employees
Route::post('/employees', [EmployeeController::class, 'post']);

// GET /employees
Route::get('/employees_per_page', [EmployeeController::class, 'per_page']);
Route::get('/employees_page', [EmployeeController::class, 'page']);
Route::get('/employees_order_by_name_asc', [EmployeeController::class, 'order_by_name_asc']);
Route::get('/employees_order_by_name_desc', [EmployeeController::class, 'order_by_name_desc']);
Route::get('/employees_order_by_salary_asc', [EmployeeController::class, 'order_by_salary_asc']);
Route::get('/employees_order_by_salary_desc', [EmployeeController::class, 'order_by_salary_desc']);

// POST /overtimes
Route::post('/overtimes', [OvertimeController::class, 'post']);

//GET /overtimes
Route::get('/overtimes', [OvertimeController::class, 'get']);

// GET /overtime-pays/calculate
Route::get('/overtime-pays/calculate', [OvertimeController::class, 'calculate']);

