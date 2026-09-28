<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        Activity::create([
            'category_id' => 1,
            'code' => 'WS-001',
            'title' => 'Workshop Git Dasar',
            'description' => 'Latihan kolaborasi repository.',
            'location' => 'Lab Komputer 1',
            'start_at' => now()->addDays(7),
            'end_at' => now()->addDays(7)->addHours(3),
            'capacity' => 30,
            'status' => 'draft',
        ]);

        Activity::create([
            'category_id' => 2,
            'code' => 'SM-001',
            'title' => 'Seminar Web Quality',
            'description' => 'Pengenalan maintainability dan testing.',
            'location' => 'Aula Gedung A',
            'start_at' => now()->addDays(14),
            'end_at' => now()->addDays(14)->addHours(2),
            'capacity' => 100,
            'status' => 'draft',
        ]);

        Activity::create([
            'category_id' => 1,
            'code' => 'WS-002',
            'title' => 'Workshop Laravel Dasar',
            'description' => 'Membangun CRUD pertama dengan Laravel.',
            'location' => 'Lab Komputer 2',
            'start_at' => now()->addDays(21),
            'end_at' => now()->addDays(21)->addHours(4),
            'capacity' => 25,
            'status' => 'draft',
        ]);
    }
}