<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StockTransaction;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class StockTransactionSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $adminUser = User::where('email', 'admin@warehouse.com')->first();
        
        if (!$adminUser) {
            $this->command->error('Admin user not found. Please run AdminSeeder first.');
            return;
        }

        // Stock IN transactions
        $stockInTransactions = [
            [
                'product_code' => 'ELK001',
                'quantity' => 5,
                'transaction_date' => Carbon::now()->subDays(30),
                'supplier_id' => 1,
                'destination' => 'Gudang Utama',
                'notes' => 'Pembelian laptop untuk karyawan baru'
            ],
            [
                'product_code' => 'ATK001',
                'quantity' => 50,
                'transaction_date' => Carbon::now()->subDays(28),
                'supplier_id' => 2,
                'destination' => 'Gudang ATK',
                'notes' => 'Stok kertas untuk 3 bulan'
            ],
            [
                'product_code' => 'FUR001',
                'quantity' => 3,
                'transaction_date' => Carbon::now()->subDays(25),
                'supplier_id' => 3,
                'destination' => 'Ruang Direktur',
                'notes' => 'Meja kerja untuk direksi baru'
            ],
            [
                'product_code' => 'ATK002',
                'quantity' => 45,
                'transaction_date' => Carbon::now()->subDays(2),
                'supplier_id' => 3,
                'destination' => 'Divisi SDM',
                'notes' => 'Pulpen untuk keperluan administrasi'
            ],
            [
                'product_code' => 'KMP001',
                'quantity' => 20,
                'transaction_date' => Carbon::now()->subDays(22),
                'supplier_id' => 4,
                'destination' => 'Gudang Komputer',
                'notes' => 'Mouse wireless untuk kantor'
            ],
            [
                'product_code' => 'KLB001',
                'quantity' => 15,
                'transaction_date' => Carbon::now()->subDays(20),
                'supplier_id' => 5,
                'destination' => 'Gudang Kebersihan',
                'notes' => 'Sapu ijuk untuk cleaning service'
            ],
            [
                'product_code' => 'K3S001',
                'quantity' => 100,
                'transaction_date' => Carbon::now()->subDays(18),
                'supplier_id' => 6,
                'destination' => 'Ruang K3',
                'notes' => 'Masker medis untuk protokol kesehatan'
            ],
            [
                'product_code' => 'PKG001',
                'quantity' => 30,
                'transaction_date' => Carbon::now()->subDays(15),
                'supplier_id' => 7,
                'destination' => 'Gudang Packaging',
                'notes' => 'Kardus untuk pengiriman produk'
            ],
            [
                'product_code' => 'MMN001',
                'quantity' => 100,
                'transaction_date' => Carbon::now()->subDays(12),
                'supplier_id' => 8,
                'destination' => 'Pantry Kantor',
                'notes' => 'Stok kopi untuk pantry'
            ],
            [
                'product_code' => 'SPT001',
                'quantity' => 25,
                'transaction_date' => Carbon::now()->subDays(10),
                'supplier_id' => 9,
                'destination' => 'Gudang Maintenance',
                'notes' => 'Oli mesin untuk kendaraan operasional'
            ],
            [
                'product_code' => 'MTL001',
                'quantity' => 100,
                'transaction_date' => Carbon::now()->subDays(8),
                'supplier_id' => 10,
                'destination' => 'Gudang Proyek',
                'notes' => 'Semen untuk renovasi kantor'
            ],
            [
                'product_code' => 'MMN004',
                'quantity' => 15,
                'transaction_date' => Carbon::now()->subDays(1),
                'supplier_id' => 8,
                'destination' => 'Ruang Meeting',
                'notes' => 'Air mineral untuk meeting'
            ],
            [
                'product_code' => 'PKG002',
                'quantity' => 15,
                'transaction_date' => Carbon::now()->subDays(3),
                'supplier_id' => 7,
                'destination' => 'Gudang Pengiriman',
                'notes' => 'Lakban untuk packing barang'
            ],
            [
                'product_code' => 'KLB002',
                'quantity' => 18,
                'transaction_date' => Carbon::now()->subDays(5),
                'supplier_id' => 5,
                'destination' => 'Cleaning Service',
                'notes' => 'Pengki untuk kebersihan lantai'
            ],
        ];

        // Create Stock IN transactions
        foreach ($stockInTransactions as $transaction) {
            $product = Product::where('code', $transaction['product_code'])->first();
            if ($product) {
                // Generate transaction code manually
                $prefix = 'IN';
                $date = $transaction['transaction_date']->format('Ymd');
                
                $lastTransaction = StockTransaction::withTrashed()
                    ->where('transaction_code', 'like', $prefix . $date . '%')
                    ->orderBy('transaction_code', 'desc')
                    ->first();

                $sequence = 1;
                if ($lastTransaction) {
                    $lastSequence = (int) substr($lastTransaction->transaction_code, -4);
                    $sequence = $lastSequence + 1;
                }

                $transactionCode = sprintf('%s%s%04d', $prefix, $date, $sequence);

                StockTransaction::create([
                    'transaction_code' => $transactionCode,
                    'product_id' => $product->id,
                    'type' => 'IN',
                    'quantity' => $transaction['quantity'],
                    'transaction_date' => $transaction['transaction_date'],
                    'supplier_id' => $transaction['supplier_id'],
                    'destination' => $transaction['destination'],
                    'notes' => $transaction['notes'],
                    'user_id' => $adminUser->id
                ]);
            }
        }

        // Stock OUT transactions
        $stockOutTransactions = [
            [
                'product_code' => 'ATK001',
                'quantity' => 10,
                'transaction_date' => Carbon::now()->subDays(15),
                'destination' => 'Divisi Akuntansi',
                'notes' => 'Pengambilan kertas untuk laporan bulanan'
            ],
            [
                'product_code' => 'KMP001',
                'quantity' => 5,
                'transaction_date' => Carbon::now()->subDays(12),
                'destination' => 'Divisi IT',
                'notes' => 'Mouse untuk komputer baru'
            ],
            [
                'product_code' => 'K3S001',
                'quantity' => 20,
                'transaction_date' => Carbon::now()->subDays(10),
                'destination' => 'Security',
                'notes' => 'Masker untuk petugas security'
            ],
            [
                'product_code' => 'MMN001',
                'quantity' => 30,
                'transaction_date' => Carbon::now()->subDays(8),
                'destination' => 'Pantry Kantor',
                'notes' => 'Kopi untuk kebutuhan pantry'
            ],
            [
                'product_code' => 'KLB002',
                'quantity' => 8,
                'transaction_date' => Carbon::now()->subDays(5),
                'destination' => 'Cleaning Service',
                'notes' => 'Pengki untuk kebersihan lantai'
            ],
            [
                'product_code' => 'PKG002',
                'quantity' => 12,
                'transaction_date' => Carbon::now()->subDays(3),
                'destination' => 'Gudang Pengiriman',
                'notes' => 'Lakban untuk packing barang'
            ],
            [
                'product_code' => 'ATK002',
                'quantity' => 25,
                'transaction_date' => Carbon::now()->subDays(2),
                'destination' => 'Divisi SDM',
                'notes' => 'Pulpen untuk keperluan administrasi'
            ],
            [
                'product_code' => 'MMN004',
                'quantity' => 5,
                'transaction_date' => Carbon::now()->subDays(1),
                'destination' => 'Ruang Meeting',
                'notes' => 'Air mineral untuk meeting'
            ],
        ];

        // Create Stock OUT transactions
        foreach ($stockOutTransactions as $transaction) {
            $product = Product::where('code', $transaction['product_code'])->first();
            if ($product) {
                // Generate transaction code manually
                $prefix = 'OUT';
                $date = $transaction['transaction_date']->format('Ymd');
                
                $lastTransaction = StockTransaction::withTrashed()
                    ->where('transaction_code', 'like', $prefix . $date . '%')
                    ->orderBy('transaction_code', 'desc')
                    ->first();

                $sequence = 1;
                if ($lastTransaction) {
                    $lastSequence = (int) substr($lastTransaction->transaction_code, -4);
                    $sequence = $lastSequence + 1;
                }

                $transactionCode = sprintf('%s%s%04d', $prefix, $date, $sequence);

                StockTransaction::create([
                    'transaction_code' => $transactionCode,
                    'product_id' => $product->id,
                    'type' => 'OUT',
                    'quantity' => $transaction['quantity'],
                    'transaction_date' => $transaction['transaction_date'],
                    'destination' => $transaction['destination'],
                    'notes' => $transaction['notes'],
                    'user_id' => $adminUser->id
                ]);
            }
        }
    }
}