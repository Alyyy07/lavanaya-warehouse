<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'description' => 'Barang elektronik dan gadget'],
            ['name' => 'Alat Tulis Kantor', 'description' => 'Peralatan tulis dan kantor'],
            ['name' => 'Furniture', 'description' => 'Peralatan kantor dan rumah tangga'],
            ['name' => 'Komputer', 'description' => 'Perangkat komputer dan aksesoris'],
            ['name' => 'Peralatan Kebersihan', 'description' => 'Alat-alat kebersihan'],
            ['name' => 'Kesehatan & K3', 'description' => 'Peralatan kesehatan dan keselamatan kerja'],
            ['name' => 'Packaging', 'description' => 'Kemasan dan pengemas'],
            ['name' => 'Makanan & Minuman', 'description' => 'Konsumsi untuk pantry kantor'],
            ['name' => 'Sparepart', 'description' => 'Suku cadang mesin dan peralatan'],
            ['name' => 'Material Bangunan', 'description' => 'Material untuk renovasi dan bangunan'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}