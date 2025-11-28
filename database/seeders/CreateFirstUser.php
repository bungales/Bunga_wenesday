<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    public function run(): void
    {
        // Reset tabel users
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Insert Admin
        User::create([
            'name'     => 'Admin',
            'email'    => 'gatot@pcr.ac.id',
            'password' => Hash::make('gatotkaca'),
        ]);

        // 100 Nama Indonesia
        $names = [
            'Budi Santoso','Siti Aminah','Agus Saputra','Dewi Lestari','Andi Prasetyo',
            'Rina Marlina','Fajar Hidayat','Putri Wulandari','Rizki Pratama','Nur Aisyah',
            'Doni Setiawan','Melati Kusuma','Arif Budiman','Intan Sari','Hendra Wijaya',
            'Nadia Ayu','Rahmat Hidayat','Desi Puspita','Yudi Kurniawan','Aulia Rahman',
            'Tono Susanto','Lisa Kusnadi','Feri Firmansyah','Ayu Lestari','Indra Saputra',
            'Fitri Handayani','Joko Purnomo','Sari Widya','Rama Prabowo','Nina Kartika',
            'Haris Cahyono','Putra Mahendra','Ayu Safitri','Farhan Taufik','Dhika Maulana',
            'Lestari Dewi','Bagas Nugroho','Cici Anggraini','Galih Saputra','Silvia Nuraini',
            'Imam Fauzi','Yuni Handayani','Rio Setiawan','Bella Anggraeni','Zaki Pratama',
            'Mega Lestari','Rafi Ramadhan','Nina Salsabila','Dimas Pratomo','Salsa Permata',
            'Fahri Andika','Sinta Wulandari','Ridho Prasetya','Nanda Putri','Andika Syahputra',
            'Tia Melani','Arya Pratama','Wulan Lestari','Randy Firmansyah','Vina Aprilia',
            'Hana Azzahra','Ilham Saputra','Citra Putri','Zahra Khairunnisa','Wildan Ramadhan',
            'Lina Marlina','Ari Wibowo','Amelia Sari','Taufik Hidayat','Novi Anggraeni',
            'Reza Prasetyo','Aurel Ningsih','Sofyan Hidayat','Nabila Rahma','Yoga Permana',
            'Tania Lestari','Dhani Pratama','Kartika Sari','Vivo Anggraeni','Rafli Pramudya',
            'Maya Lestari','Tito Wibisono','Anisa Amelia','Ivan Prasetya','Qori Lestari',
            'Gilang Maulana','Cindy Rahma','Bastian Saputra','Alya Fadilah','Ariani Putri',
            'Hasan Basri','Mila Anggrek','Fauzan Pratama','Nadya Cahyani','Kevin Saputra',
            'Rani Oktaviani','Bagus Prabowo','Dian Kurnia','Mahendra Putra','Tiara Mentari'
        ];

        // Insert 100 user
        for ($i = 1; $i <= 100; $i++) {
            User::create([
                'name'     => $names[$i - 1],
                'email'    => 'user' . $i . '@example.com',
                'password' => Hash::make('password' . $i),
            ]);
        }
    }
}
