<?php

use App\Modules\Auth\AuthController;
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

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);



Route::get('/appointments/doctor', 'App\Modules\Appointment\Http\Controllers\AppointmentController@listByDoctor')->middleware('auth:api');

Route::post('/appointments/{id}/assign', 'App\Modules\Appointment\Http\Controllers\AppointmentController@assignToDoctor')->middleware('auth:api');

Route::post('/appointments', 'App\Modules\Appointment\Http\Controllers\AppointmentController@store')->middleware('auth:api');
Route::get('/appointments', 'App\Modules\Appointment\Http\Controllers\AppointmentController@index')->middleware('auth:api');
Route::get('/appointments/{id}', 'App\Modules\Appointment\Http\Controllers\AppointmentController@show')->middleware('auth:api');
Route::put('/appointments/{id}', 'App\Modules\Appointment\Http\Controllers\AppointmentController@update')->middleware('auth:api');

// users

Route::post('/users', 'App\Modules\User\Http\Controllers\UserController@store');
Route::get('/doctors', 'App\Modules\User\Http\Controllers\UserController@index');
