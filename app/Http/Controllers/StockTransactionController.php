<?php

namespace App\Http\Controllers;

use App\Models\StockTransaction;
use App\Models\Product;
use App\Models\Supplier;
use App\Http\Requests\StoreStockTransactionRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockTransactionController extends Controller
{
    /**
     * Display a listing of stock in transactions.
     */
    public function indexIn()
    {
        $transactions = StockTransaction::with(['product', 'supplier', 'user'])
            ->where('type', 'IN')
            ->latest('transaction_date')
            ->latest('created_at')
            ->paginate(10);

        return view('transactions.stock_in.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new stock in transaction.
     */
    public function createIn()
    {
        $products = Product::with(['category' => function($query) {
            $query->whereNull('deleted_at');
        }])->whereHas('category', function($query) {
            $query->whereNull('deleted_at');
        })->orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();

        return view('transactions.stock_in.create', compact('products', 'suppliers'));
    }

    /**
     * Store a newly created stock in transaction.
     */
    public function storeIn(StoreStockTransactionRequest $request)
    {
        DB::transaction(function () use ($request) {
            StockTransaction::create([
                'product_id' => $request->product_id,
                'type' => 'IN',
                'quantity' => $request->quantity,
                'transaction_date' => $request->transaction_date,
                'supplier_id' => $request->supplier_id,
                'notes' => $request->notes,
                'user_id' => Auth::id(),
            ]);
        });

        return redirect()->route('transactions.in.index')
            ->with('success', 'Barang masuk berhasil dicatat.');
    }

    /**
     * Display a listing of stock out transactions.
     */
    public function indexOut()
    {
        $transactions = StockTransaction::with(['product', 'user'])
            ->where('type', 'OUT')
            ->latest('transaction_date')
            ->latest('created_at')
            ->paginate(10);

        return view('transactions.stock_out.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new stock out transaction.
     */
    public function createOut()
    {
        $products = Product::with(['category' => function($query) {
            $query->whereNull('deleted_at');
        }])->whereHas('category', function($query) {
            $query->whereNull('deleted_at');
        })->orderBy('name')->get();

        return view('transactions.stock_out.create', compact('products'));
    }

    /**
     * Store a newly created stock out transaction.
     */
    public function storeOut(StoreStockTransactionRequest $request)
    {
        $product = Product::findOrFail($request->product_id);

        if ($product->current_stock < $request->quantity) {
            return back()->withInput()->withErrors(['quantity' => 'Stok produk tidak mencukupi. Stok saat ini: ' . $product->current_stock]);
        }

        DB::transaction(function () use ($request) {
            StockTransaction::create([
                'product_id' => $request->product_id,
                'type' => 'OUT',
                'quantity' => $request->quantity,
                'transaction_date' => $request->transaction_date,
                'destination' => $request->destination,
                'notes' => $request->notes,
                'user_id' => Auth::id(),
            ]);
        });

        return redirect()->route('transactions.out.index')
            ->with('success', 'Barang keluar berhasil dicatat.');
    }

    public function destroy(StockTransaction $transaction)
    {
        $transaction->delete();

        $route = $transaction->type == 'IN' ? 'transactions.in.index' : 'transactions.out.index';
        return redirect()->route($route)->with('success', 'Transaksi berhasil dibatalkan (Void).');
    }
}
