<?php
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
// Route example
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware([AuthMiddleware::class])->get('/hello', function () {
    return response()->json(['message' => 'Hello World']);
});