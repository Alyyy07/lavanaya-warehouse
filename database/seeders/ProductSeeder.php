<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $products = [
            // Elektronik
            ['code' => 'ELK001', 'name' => 'Laptop ASUS ROG', 'category_id' => 1, 'supplier_id' => 1, 'unit' => 'Unit', 'price' => 15000000],
            ['code' => 'ELK002', 'name' => 'Monitor LG 24"', 'category_id' => 1, 'supplier_id' => 1, 'unit' => 'Unit', 'price' => 2500000],
            ['code' => 'ELK003', 'name' => 'Printer Epson L3150', 'category_id' => 1, 'supplier_id' => 1, 'unit' => 'Unit', 'price' => 3500000],

            // Alat Tulis Kantor
            ['code' => 'ATK001', 'name' => 'Kertas HVS A4 80gr', 'category_id' => 2, 'supplier_id' => 2, 'unit' => 'Rim', 'price' => 45000],
            ['code' => 'ATK002', 'name' => ' Pilot V5', 'category_id' => 2, 'supplier_id' => 2, 'unit' => 'Pcs', 'price' => 15000],
            ['code' => 'ATK003', 'name' => 'Spidol Whiteboard', 'category_id' => 2, 'supplier_id' => 2, 'unit' => 'Pcs', 'price' => 8000],
            ['code' => 'ATK004', 'name' => 'Stapler Kenko', 'category_id' => 2, 'supplier_id' => 2, 'unit' => 'Pcs', 'price' => 25000],
            ['code' => 'ATK005', 'name' => 'Map Plastik Kecil', 'category_id' => 2, 'supplier_id' => 2, 'unit' => 'Pcs', 'price' => 3000],

            // Furniture
            ['code' => 'FUR001', 'name' => 'Meja Kerja Direktur', 'category_id' => 3, 'supplier_id' => 3, 'unit' => 'Unit', 'price' => 3500000],
            ['code' => 'FUR002', 'name' => 'Kursi Kantor Ergonomis', 'category_id' => 3, 'supplier_id' => 3, 'unit' => 'Unit', 'price' => 1800000],
            ['code' => 'FUR003', 'name' => 'Rak Besi 5 Susun', 'category_id' => 3, 'supplier_id' => 3, 'unit' => 'Unit', 'price' => 750000],
            ['code' => 'FUR004', 'name' => 'Lemari Arsir Kayu', 'category_id' => 3, 'supplier_id' => 3, 'unit' => 'Unit', 'price' => 2200000],

            // Komputer
            ['code' => 'KMP001', 'name' => 'Mouse Logitech M171', 'category_id' => 4, 'supplier_id' => 4, 'unit' => 'Pcs', 'price' => 150000],
            ['code' => 'KMP002', 'name' => 'Keyboard Mechanical', 'category_id' => 4, 'supplier_id' => 4, 'unit' => 'Pcs', 'price' => 450000],
            ['code' => 'KMP003', 'name' => 'Flashdisk SanDisk 32GB', 'category_id' => 4, 'supplier_id' => 4, 'unit' => 'Pcs', 'price' => 85000],
            ['code' => 'KMP004', 'name' => 'Harddisk External 1TB', 'category_id' => 4, 'supplier_id' => 4, 'unit' => 'Pcs', 'price' => 650000],

            // Peralatan Kebersihan
            ['code' => 'KLB001', 'name' => 'Sapu Ijuk', 'category_id' => 5, 'supplier_id' => 5, 'unit' => 'Pcs', 'price' => 35000],
            ['code' => 'KLB002', 'name' => 'Pengki Plastik', 'category_id' => 5, 'supplier_id' => 5, 'unit' => 'Pcs', 'price' => 25000],
            ['code' => 'KLB003', 'name' => 'Kain Lap Microfiber', 'category_id' => 5, 'supplier_id' => 5, 'unit' => 'Pcs', 'price' => 15000],
            ['code' => 'KLB004', 'name' => 'Sapu Lantai Otomatis', 'category_id' => 5, 'supplier_id' => 5, 'unit' => 'Unit', 'price' => 850000],
            ['code' => 'KLB005', 'name' => 'Tempat Sampah Stainless', 'category_id' => 5, 'supplier_id' => 5, 'unit' => 'Unit', 'price' => 450000],

            // Kesehatan & K3
            ['code' => 'K3S001', 'name' => 'Masker Medis 3 Ply', 'category_id' => 6, 'supplier_id' => 6, 'unit' => 'Box', 'price' => 25000],
            ['code' => 'K3S002', 'name' => 'Hand Sanitizer 500ml', 'category_id' => 6, 'supplier_id' => 6, 'unit' => 'Botol', 'price' => 35000],
            ['code' => 'K3S003', 'name' => 'Sarung Tangan Karet', 'category_id' => 6, 'supplier_id' => 6, 'unit' => 'Pasang', 'price' => 15000],
            ['code' => 'K3S004', 'name' => 'Helm Safety Proyek', 'category_id' => 6, 'supplier_id' => 6, 'unit' => 'Pcs', 'price' => 125000],
            ['code' => 'K3S005', 'name' => 'APAR 3 Kg ABC', 'category_id' => 6, 'supplier_id' => 6, 'unit' => 'Unit', 'price' => 450000],

            // Packaging
            ['code' => 'PKG001', 'name' => 'Kardus Box Sedang', 'category_id' => 7, 'supplier_id' => 7, 'unit' => 'Lusin', 'price' => 60000],
            ['code' => 'PKG002', 'name' => 'Lakban Coklat', 'category_id' => 7, 'supplier_id' => 7, 'unit' => 'Roll', 'price' => 20000],
            ['code' => 'PKG003', 'name' => 'Plastic Wrap', 'category_id' => 7, 'supplier_id' => 7, 'unit' => 'Roll', 'price' => 45000],
            ['code' => 'PKG004', 'name' => 'Bubble Wrap 1.2m', 'category_id' => 7, 'supplier_id' => 7, 'unit' => 'Roll', 'price' => 85000],

            // Makanan & Minuman
            ['code' => 'MMN001', 'name' => 'Kopi Kapal Api', 'category_id' => 8, 'supplier_id' => 8, 'unit' => 'Pack', 'price' => 12000],
            ['code' => 'MMN002', 'name' => 'Teh Gelas', 'category_id' => 8, 'supplier_id' => 8, 'unit' => 'Karton', 'price' => 85000],
            ['code' => 'MMN003', 'name' => 'Gula Pasir 1kg', 'category_id' => 8, 'supplier_id' => 8, 'unit' => 'Kg', 'price' => 15000],
            ['code' => 'MMN004', 'name' => 'Air Mineral 600ml', 'category_id' => 8, 'supplier_id' => 8, 'unit' => 'Karton', 'price' => 55000],
            ['code' => 'MMN005', 'name' => 'Biskuit Regina', 'category_id' => 8, 'supplier_id' => 8, 'unit' => 'Karton', 'price' => 75000],

            // Sparepart
            ['code' => 'SPT001', 'name' => 'Oli Mesin 5L', 'category_id' => 9, 'supplier_id' => 9, 'unit' => 'Botol', 'price' => 125000],
            ['code' => 'SPT002', 'name' => 'Aki Mobil NS40', 'category_id' => 9, 'supplier_id' => 9, 'unit' => 'Pcs', 'price' => 650000],
            ['code' => 'SPT003', 'name' => 'Ban Luar Mobil', 'category_id' => 9, 'supplier_id' => 9, 'unit' => 'Pcs', 'price' => 850000],
            ['code' => 'SPT004', 'name' => 'Filter AC Mobil', 'category_id' => 9, 'supplier_id' => 9, 'unit' => 'Pcs', 'price' => 95000],

            // Material Bangunan
            ['code' => 'MTL001', 'name' => 'Semen 40kg', 'category_id' => 10, 'supplier_id' => 10, 'unit' => 'Sak', 'price' => 55000],
            ['code' => 'MTL002', 'name' => 'Besi Beton 10mm', 'category_id' => 10, 'supplier_id' => 10, 'unit' => 'Batang', 'price' => 85000],
            ['code' => 'MTL003', 'name' => 'Cat Tembok 5kg', 'category_id' => 10, 'supplier_id' => 10, 'unit' => 'Kaleng', 'price' => 125000],
            ['code' => 'MTL004', 'name' => 'Pasir 1m³', 'category_id' => 10, 'supplier_id' => 10, 'unit' => 'M³', 'price' => 285000],
            ['code' => 'MTL005', 'name' => 'Bata Merah', 'category_id' => 10, 'supplier_id' => 10, 'unit' => 'Buah', 'price' => 950],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
