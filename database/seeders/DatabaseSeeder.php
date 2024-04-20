<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(100)->create();
        \App\Models\supplier::factory(100)->create();
        \App\Models\EquipmentType::factory(30)->create();
        \App\Models\Equipment::factory(200)->create();
        \App\Models\allocation::factory(100)->create();
        \App\Models\EquipmentCategory::factory(100)->create();
        DB::table('users')->insert([
            'code' => 'ADMIN',
            'name' => 'admin',
            'email' => 'admin',
            'password' => Hash::make('1'),
            'updated_at' => now(),
            'status' => 1
        ]);
    }
}
