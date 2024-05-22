<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     * run with php artisan migrate:fresh --seed
     */
    public function run(): void
    {
        // using factory to create test data
            //Company::factory()->count(10)->create();
            //Contact::factory()->count(100)->create();
        // we are using relationships to seed our data AND can instead us this
        // we have also added another class inside to do this
        Company::factory(10)->hasContacts(10)->create();
    }
}
