<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => [],
    'prefix' => 'admin'
], function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login.form');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::group([
        'middleware' => [
            'auth.admin'
        ]
    ], function () {
        Route::resources([
            'users' => UserController::class,
            'categories' => CategoryController::class,
            'attributes' => AttributeController::class,
            'products' => ProductController::class,
            'stores' => StoreController::class,
            'orders' => OrderController::class,
            'posts' => PostController::class
        ]);

        Route::get('orders/{order}/billing', [OrderController::class, 'getBilling'])->name('orders.billing');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('chart', [DashboardController::class, 'getChart'])->name('dashboard.chart');

        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::post('products/{product}/prices', [ProductController::class, 'createProductPrices'])->name('products.prices.store');

        Route::delete('products/{product}/prices/{product_price_id}', [ProductController::class, 'deleteProductPrices'])->name('products.prices.destroy');

        Route::put('products/{product}/prices/{product_price_id}', [ProductController::class, 'updateProductPrices'])->name('products.prices.update');
    });
});
