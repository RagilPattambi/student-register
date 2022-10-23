<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentDetailsController;
use App\Http\Controllers\MarkListController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [StudentDetailsController::class,'index']);
Route::post('/store', [StudentDetailsController::class,'store']);
Route::post('/edit', [StudentDetailsController::class,'edit']);
Route::post('/update', [StudentDetailsController::class,'update']);
Route::get('delete/{id}',[StudentDetailsController::class,'destroy']);
Route::get('/marklist', [MarkListController::class,'index']);
Route::post('/marklist/store', [MarkListController::class,'store']);
Route::post('/marklist/edit', [MarkListController::class,'edit']);
Route::post('/marklist/update', [MarkListController::class,'update']);
Route::get('marklist/delete/{id}',[MarkListController::class,'destroy']);



