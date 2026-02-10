<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockTransactionController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::post('categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore')->withTrashed();
    Route::resource('categories', CategoryController::class);

    Route::post('suppliers/{supplier}/restore', [SupplierController::class, 'restore'])->name('suppliers.restore')->withTrashed();
    Route::resource('suppliers', SupplierController::class);
    Route::post('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore')->withTrashed();
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);

    // Transactions
    Route::prefix('transactions')->name('transactions.')->group(function () {
        // Stock In
        Route::get('in', [StockTransactionController::class, 'indexIn'])->name('in.index');
        Route::get('in/create', [StockTransactionController::class, 'createIn'])->name('in.create');
        Route::post('in', [StockTransactionController::class, 'storeIn'])->name('in.store');

        // Stock Out
        Route::get('out', [StockTransactionController::class, 'indexOut'])->name('out.index');
        Route::get('out/create', [StockTransactionController::class, 'createOut'])->name('out.create');
        Route::post('out', [StockTransactionController::class, 'storeOut'])->name('out.store');

        // Delete Transaction
        Route::delete('{transaction}', [StockTransactionController::class, 'destroy'])->name('destroy');
    });

    // Reports
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('stock', [ReportController::class, 'stock'])->name('stock');
        Route::get('transactions', [ReportController::class, 'transactions'])->name('transactions');
    });
});
