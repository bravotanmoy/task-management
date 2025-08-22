<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return response()->json(['message' => 'Hello world!']);
});



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



// Route::middleware('jwt')->group(function () {
//     Route::get('/me', [AuthController::class, 'me']);
//     Route::get('/user', [AuthController::class, 'getUser']);
//     Route::put('/user', [AuthController::class, 'updateUser']);
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

Route::middleware('auth.api')->get('/me', function () {
    return response()->json(auth('api')->user());
});