<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => [],
    'prefix' => 'admin'
], function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('login-form');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::group([
        'middleware' => [
            'auth.admin'
        ]
    ], function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::resources([
            'users' => UserController::class,
        ]);
    });
});
