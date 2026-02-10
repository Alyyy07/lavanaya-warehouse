<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'PT. Teknologi Maju Bersama',
                'contact_person' => 'Budi Santoso',
                'phone' => '021-5551234',
                'email' => 'budi@teknologimaju.com',
                'address' => 'Jl. Gatot Subroto No. 123, Jakarta Selatan'
            ],
            [
                'name' => 'CV. Sentra Alat Tulis',
                'contact_person' => 'Siti Nurhaliza',
                'phone' => '022-7654321',
                'email' => 'siti@sentraat.com',
                'address' => 'Jl. Dago No. 45, Bandung'
            ],
            [
                'name' => 'PT. Indah Mebel Jaya',
                'contact_person' => 'Ahmad Fadli',
                'phone' => '031-8899776',
                'email' => 'ahmad@indahmebel.com',
                'address' => 'Jl. Raya Surabaya No. 78, Surabaya'
            ],
            [
                'name' => 'UD. Komputer Plus',
                'contact_person' => 'Diana Putri',
                'phone' => '024-6677553',
                'email' => 'diana@komputerplus.com',
                'address' => 'Jl. Pahlawan No. 12, Semarang'
            ],
            [
                'name' => 'PT. Bersih Sehat Indonesia',
                'contact_person' => 'Rudi Hermawan',
                'phone' => '061-3322110',
                'email' => 'rudi@bersihsehat.com',
                'address' => 'Jl. Sisingamangaraja No. 56, Medan'
            ],
            [
                'name' => 'CV. Medika Safety',
                'contact_person' => 'Dr. Sarah Wijaya',
                'phone' => '0274-4455667',
                'email' => 'sarah@medikasafety.com',
                'address' => 'Jl. Kaliurang No. 89, Yogyakarta'
            ],
            [
                'name' => 'PT. Kemasan Prima',
                'contact_person' => 'Eko Prasetyo',
                'phone' => '0711-4455889',
                'email' => 'eko@kemasanprima.com',
                'address' => 'Jl. Sudirman No. 34, Palembang'
            ],
            [
                'name' => 'UD. Pangan Sejahtera',
                'contact_person' => 'Linda Sari',
                'phone' => '0411-5566778',
                'email' => 'linda@pangansejahtera.com',
                'address' => 'Jl. Pettarani No. 67, Makassar'
            ],
            [
                'name' => 'PT. Sukses Partsindo',
                'contact_person' => 'Hendra Kusuma',
                'phone' => '0541-1122334',
                'email' => 'hendra@suksesparts.com',
                'address' => 'Jl. Ahmad Yani No. 23, Balikpapan'
            ],
            [
                'name' => 'CV. Material Makmur',
                'contact_person' => 'Bambang Sutrisno',
                'phone' => '0761-9900112',
                'email' => 'bambang@materialmakmur.com',
                'address' => 'Jl. Tuanku Tambusai No. 90, Pekanbaru'
            ]
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}