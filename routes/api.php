<?php

use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ReportController;
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
    //bai5
    Route::prefix('reports')->group(function () {
        // Báo cáo sản phẩm
        Route::get('products', [ReportController::class, 'getProductsReports']);
        Route::get('products/{id}', [ReportController::class, 'getProductReport']);
        Route::post('products', [ReportController::class, 'createProductReport']);
        Route::delete('products/{id}', [ReportController::class, 'deleteProductReport']);
        
        // Báo cáo đơn hàng
        Route::get('orders', [ReportController::class, 'getOrdersReports']);
        Route::get('orders/{id}', [ReportController::class, 'getOrderReport']);
        Route::post('orders', [ReportController::class, 'createOrderReport']);
        Route::delete('orders/{id}', [ReportController::class, 'deleteOrderReport']);
    });
});
