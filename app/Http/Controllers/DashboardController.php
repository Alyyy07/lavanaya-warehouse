<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $supplierCount = Supplier::count();

        $products = Product::all();
        $stockValue = $products->sum(function ($product) {
            return $product->price * $product->current_stock;
        });

        if ($stockValue >= 1000000000) {
            $formattedStockValue = number_format($stockValue / 1000000000, 1, ',', '.');
            $stockValueSuffix = 'M';
        } elseif ($stockValue >= 1000000) {
            $formattedStockValue = number_format($stockValue / 1000000, 1, ',', '.');
            $stockValueSuffix = 'Jt';
        } else {
            $formattedStockValue = number_format($stockValue / 1000, 0, ',', '.');
            $stockValueSuffix = 'k';
        }

        $transactionsToday = StockTransaction::whereDate('transaction_date', now())->count();

        $lowStockProducts = $products->filter(function ($product) {
            return $product->current_stock > 0 && $product->current_stock < 10;
        });

        $outOfStockProducts = $products->filter(function ($product) {
            return $product->current_stock <= 0;
        });

        $recentTransactions = StockTransaction::with(['product', 'user', 'supplier'])
            ->latest('transaction_date')
            ->latest('created_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'productCount',
            'categoryCount',
            'supplierCount',
            'stockValue',
            'formattedStockValue',
            'stockValueSuffix',
            'transactionsToday',
            'lowStockProducts',
            'outOfStockProducts',
            'recentTransactions'
        ));
    }
}
