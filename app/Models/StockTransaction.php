<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;

use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransaction extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'transaction_code',
        'product_id',
        'type',
        'quantity',
        'transaction_date',
        'supplier_id',
        'destination',
        'notes',
        'user_id'
    ];

    protected $casts = [
        'transaction_date' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Auto-generate transaction code
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            $prefix = $transaction->type === 'IN' ? 'IN' : 'OUT';
            $date = date('Ymd');

            // Find the last transaction code for this type and date, including soft-deleted ones
            $lastTransaction = StockTransaction::withTrashed()
                ->where('transaction_code', 'like', $prefix . $date . '%')
                ->orderBy('transaction_code', 'desc')
                ->first();

            $sequence = 1;
            if ($lastTransaction) {
                // Extract sequence from code (e.g., IN202602090001 -> 1)
                $lastSequence = (int) substr($lastTransaction->transaction_code, -4);
                $sequence = $lastSequence + 1;
            }

            $transaction->transaction_code = sprintf('%s%s%04d', $prefix, $date, $sequence);
        });
    }
}
