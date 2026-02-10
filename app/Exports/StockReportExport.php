<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $products;

    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->products;
    }

    public function headings(): array
    {
        return [
            'Kode Produk',
            'Nama Produk',
            'Kategori',
            'Supplier',
            'Harga',
            'Stok',
            'Satuan',
            'Status Stok',
        ];
    }

    public function map($product): array
    {
        $status = 'Aman';
        if ($product->current_stock == 0) {
            $status = 'Habis';
        } elseif ($product->current_stock < 10) {
            $status = 'Rendah';
        }

        return [
            $product->code,
            $product->name,
            $product->category->name,
            $product->supplier ? $product->supplier->name : '-',
            $product->price,
            $product->current_stock,
            $product->unit,
            $status,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
