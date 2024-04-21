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
        \App\Models\Employee::factory(100)->create();
        \App\Models\supplier::factory(100)->create();
        \App\Models\AssetType::factory(30)->create();
        \App\Models\Asset::factory(200)->create();
        \App\Models\Allocation::factory(100)->create();
        \App\Models\AssetCategory::factory(100)->create();
        DB::table('employee')->insert([
            'code' => 'ADMIN',
            'name' => 'admin',
            'email' => 'admin',
            'password' => Hash::make('1'),
            'updated_at' => now(),
            'status' => 1
        ]);
    }
}
