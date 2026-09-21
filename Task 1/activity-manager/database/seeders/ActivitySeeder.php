<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::create([
            'title' => 'Membuat Laporan Modul Laravel',
            'description' => 'Menyelesaikan modul CRUD untuk project activity-manager.',
            'status' => 'in_progress',
            'due_date' => now()->addDays(3),
        ]);

        Activity::create([
            'title' => 'Rapat Tim Pengembang',
            'description' => 'Membahas pembagian tugas fitur autentikasi.',
            'status' => 'pending',
            'due_date' => now()->addDays(5),
        ]);

        Activity::create([
            'title' => 'Desain Database Activity',
            'description' => 'Merancang ERD dan skema tabel untuk sistem manajemen aktivitas.',
            'status' => 'completed',
            'due_date' => now()->subDays(2),
        ]);

        Activity::create([
            'title' => 'Testing Fitur CRUD',
            'description' => 'Menguji fungsi create, read, update, dan delete di browser.',
            'status' => 'pending',
            'due_date' => now()->addDays(7),
        ]);

        Activity::create([
            'title' => 'Deployment ke Staging',
            'description' => 'Mempersiapkan aplikasi agar bisa diakses tim testing.',
            'status' => 'pending',
            'due_date' => now()->addDays(10),
        ]);
    }
}