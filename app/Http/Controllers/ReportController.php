<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\StockReportExport;
use App\Exports\TransactionReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    /**
     * Display stock report.
     */
    public function stock(Request $request)
    {
        $query = Product::with('category', 'supplier')->orderBy('name');

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%");
            });
        }

        if ($request->has('stock_status') && $request->stock_status != '') {
            $products = $query->get();
            
            $filteredProducts = $products->filter(function ($product) use ($request) {
                switch ($request->stock_status) {
                    case 'low':
                        return $product->current_stock > 0 && $product->current_stock < 10;
                    case 'available':
                        return $product->current_stock >= 10;
                    case 'empty':
                        return $product->current_stock <= 0;
                    default:
                        return true;
                }
            });

            // Convert filtered collection back to query for pagination
            $productIds = $filteredProducts->pluck('id')->toArray();
            $query = Product::whereIn('id', $productIds)->with('category', 'supplier')->orderBy('name');
        }

        if ($request->has('export')) {
            $products = $query->get();
            if ($request->export == 'excel') {
                return Excel::download(new StockReportExport($products), 'laporan-stok-' . date('Y-m-d') . '.xlsx');
            } elseif ($request->export == 'pdf') {
                $pdf = Pdf::loadView('reports.stock_pdf', compact('products'));
                return $pdf->download('laporan-stok-' . date('Y-m-d') . '.pdf');
            }
        }

        $products = $query->paginate(20)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('reports.stock', compact('products', 'categories'));
    }

    /**
     * Display transaction report.
     */
    public function transactions(Request $request)
    {
        $query = StockTransaction::with(['product', 'user', 'supplier'])
            ->latest('transaction_date')
            ->latest('created_at');

        if ($request->has('start_date') && $request->start_date) {
            $query->whereDate('transaction_date', '>=', $request->start_date);
        }

        if ($request->has('end_date') && $request->end_date) {
            $query->whereDate('transaction_date', '<=', $request->end_date);
        }

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        if ($request->has('product_id') && $request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        // Handle Export
        if ($request->has('export')) {
            $transactions = $query->get();
            if ($request->export == 'excel') {
                return Excel::download(new TransactionReportExport($transactions), 'laporan-transaksi-' . date('Y-m-d') . '.xlsx');
            } elseif ($request->export == 'pdf') {
                $pdf = Pdf::loadView('reports.transactions_pdf', compact('transactions'));
                return $pdf->download('laporan-transaksi-' . date('Y-m-d') . '.pdf');
            }
        }

        $transactions = $query->paginate(20)->withQueryString();
        $products = Product::orderBy('name')->get();

        return view('reports.transactions', compact('transactions', 'products'));
    }
}
