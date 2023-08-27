<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\EmployeeController;
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


Route::prefix('admin')->middleware(['auth:sanctum', 'isAdmin'])->group(function () {
   
    Route::prefix('user')->group(function(){

        Route::get('/',[UserController::class, 'index']);

    });

    Route::prefix('employee')->group(function(){

        Route::get('/',[EmployeeController::class, 'index']);
        Route::post('add',[EmployeeController::class,'store']);
        Route::post('delete',[EmployeeController::class,'delete']);
        Route::post('restore',[EmployeeController::class,'restore']);

    });
   
    // ... other admin routes ...
});
