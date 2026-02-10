<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockTransaction;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'category_id',
        'supplier_id',
        'unit',
        'price',
        'image',
        'description'
    ];

    protected $appends = ['current_stock'];

    public function category()
    {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class)->withTrashed();
    }

    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function getCurrentStockAttribute()
    {
        $in = $this->stockTransactions()->where('type', 'IN')->sum('quantity');
        $out = $this->stockTransactions()->where('type', 'OUT')->sum('quantity');
        return $in - $out;
    }
}
