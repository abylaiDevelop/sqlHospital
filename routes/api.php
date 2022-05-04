<?php

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



Route::get("/employees",[\App\Http\Controllers\MainController::class,"index"]);
Route::post("/register",[\App\Http\Controllers\Api\SessionController::class,"register"]);
Route::post("/login",[\App\Http\Controllers\Api\SessionController::class,"login"]);
Route::apiResource("department", \App\Http\Controllers\Api\DepartmentController::class);
Route::apiResource("users", \App\Http\Controllers\Api\UserController::class);
Route::apiResource("patients", \App\Http\Controllers\Api\PatientController::class);
Route::get("/medcentre", [\App\Http\Controllers\Api\DepartmentController::class, "medCenter"]);
Route::get("/doctors", [\App\Http\Controllers\DoctorController::class, "index"]);
Route::get("/patients/search/{name}", [\App\Http\Controllers\Api\PatientController::class, "search"]);
