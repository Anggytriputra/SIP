<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\EmployeeController::class, 'index']);
Route::get('/employee/get/{id}', [App\Http\Controllers\EmployeeController::class, 'getEmployee']);
Route::post('/employee/save', [App\Http\Controllers\EmployeeController::class, 'storeEmployee']);
Route::post('/employee/edit', [App\Http\Controllers\EmployeeController::class, 'editEmployee']);
Route::post('/employee/delete/{id}', [App\Http\Controllers\EmployeeController::class, 'deleteEmployee']);
