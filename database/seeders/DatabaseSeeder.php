<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * run with php artisan migrate:fresh --seed  
     */
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            ContactSeeder::class
        ]);
    }
}
