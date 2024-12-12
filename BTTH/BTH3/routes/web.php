<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\medicinesController;
use App\Http\Controllers\classesController;
use App\Http\Controllers\computersController;
use App\Http\Controllers\salesController;
use App\Http\Controllers\issuesController;
use App\Http\Controllers\studentsController;
use App\Models\classes;

Route::get('/', function () {
    return view('index');
});
Route::get('medicines', [medicinesController::class, 'index']);
Route::get('classes', [classesController::class, 'index']);
Route::get('computers', [computersController::class, 'index']);
Route::get('sales', [salesController::class, 'index']);
Route::get('issues', [issuesController::class, 'index']);
Route::get('students', [studentsController::class, 'index']);