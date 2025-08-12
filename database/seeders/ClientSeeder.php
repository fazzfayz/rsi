<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'name' => 'PT Maju Bersama',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 12190',
                'join_year' => 2020,
                'phone' => '021-5550123',
                'email' => 'info@majubersama.com',
                'description' => 'Perusahaan teknologi yang bergerak di bidang pengembangan software dan konsultasi IT.',
                'status' => 'active'
            ],
            [
                'name' => 'CV Sukses Mandiri',
                'address' => 'Jl. Gatot Subroto No. 456, Jakarta Selatan, DKI Jakarta 12950',
                'join_year' => 2021,
                'phone' => '021-5550456',
                'email' => 'contact@suksesmandiri.co.id',
                'description' => 'Perusahaan retail yang memiliki jaringan toko di seluruh Indonesia.',
                'status' => 'active'
            ],
            [
                'name' => 'UD Makmur Jaya',
                'address' => 'Jl. Thamrin No. 789, Jakarta Pusat, DKI Jakarta 10350',
                'join_year' => 2019,
                'phone' => '021-5550789',
                'email' => 'admin@makmurjaya.com',
                'description' => 'Perusahaan manufaktur yang memproduksi berbagai produk elektronik.',
                'status' => 'active'
            ],
            [
                'name' => 'PT Global Solutions',
                'address' => 'Jl. Rasuna Said No. 321, Jakarta Selatan, DKI Jakarta 12940',
                'join_year' => 2022,
                'phone' => '021-5550321',
                'email' => 'info@globalsolutions.id',
                'description' => 'Perusahaan konsultan bisnis yang membantu perusahaan dalam transformasi digital.',
                'status' => 'active'
            ],
            [
                'name' => 'CV Berkah Abadi',
                'address' => 'Jl. Hayam Wuruk No. 654, Jakarta Barat, DKI Jakarta 11180',
                'join_year' => 2018,
                'phone' => '021-5550654',
                'email' => 'berkah@abadi.com',
                'description' => 'Perusahaan properti yang mengembangkan perumahan dan gedung komersial.',
                'status' => 'inactive'
            ]
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}
