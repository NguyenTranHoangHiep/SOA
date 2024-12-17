<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
// Routes liên quan đến Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Route bảo vệ API
Route::middleware([AuthMiddleware::class])->group(function () {
    // Example route
    Route::get('/hello', function () {
        return response()->json(['message' => 'Hello World']);
    });

    // Bảo vệ API Product
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

    // Bảo vệ API Order
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

    Route::get('/order_items', [OrderItemController::class, 'index']);
    Route::get('/order_items/{id}', [OrderItemController::class, 'show']);
    Route::post('/order_items', [OrderItemController::class, 'store']);
    Route::put('/order_items/{id}', [OrderItemController::class, 'update']);
    Route::delete('/order_items/{id}', [OrderItemController::class, 'destroy']);
});
