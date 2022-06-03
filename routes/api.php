<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getTasks', [TaskController::class, 'getTasks']);
Route::post('storeTask', [TaskController::class, 'storeTask']);
Route::post('updateTask/{id}', [TaskController::class, 'updateTask']);
Route::post('deleteTask/{id}', [TaskController::class, 'deleteTask']);

Route::post('storeSubTask', [TaskController::class, 'storeSubTask']);
Route::post('updateSubTask/{id}', [TaskController::class, 'updateSubTask']);
Route::post('deleteSubTask/{id}', [TaskController::class, 'deleteSubTask']);
Route::post('markAsComplete/{id}', [TaskController::class, 'markAsComplete']);
Route::post('markAsIncomplete/{id}', [TaskController::class, 'markAsIncomplete']);