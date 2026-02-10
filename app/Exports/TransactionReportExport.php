<?php

namespace App\Exports;

use App\Models\StockTransaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionReportExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->transactions;
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Kode Transaksi',
            'Produk',
            'Tipe',
            'Jumlah',
            'Satuan',
            'Supplier / Tujuan',
            'Catatan',
            'Oleh User',
        ];
    }

    public function map($transaction): array
    {
        $partner = '-';
        if ($transaction->type == 'IN') {
            $partner = $transaction->supplier ? $transaction->supplier->name : '-';
        } else {
            $partner = $transaction->destination ?? '-';
        }

        return [
            \Carbon\Carbon::parse($transaction->transaction_date)->translatedFormat('d F Y'),
            $transaction->transaction_code,
            $transaction->product->name,
            $transaction->type,
            $transaction->quantity,
            $transaction->product->unit,
            $partner,
            $transaction->notes,
            $transaction->user->name,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
