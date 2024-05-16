<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Contact;
use Faker\Factory as Faker;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::all();
        $faker = Faker::create();
        $contacts =[];

        foreach ($companies as $company){
            foreach(range(1,5) as $index){
                $contact =[
                    'first_name' => $faker->firstName(),
                    'last_name' => $faker->firstName(),
                    'phone' => $faker->firstName(),
                    'email' => $faker->email(),
                    'address' => $faker->address(),
                    'company_id' =>$company->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
                $contacts[] = $contact;
            }
        }
        Contact::insert($contacts);
    }
}
