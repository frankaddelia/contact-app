<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts = [];
        $companyIds = Company::pluck('id');
        $faker = Faker::create();

        foreach (range(1, rand(10, 100)) as $count) {
            $includeUpdatedAt = rand(1, 1000) >= 100;

            $contact = [
                'company_id' => $companyIds[rand(0, count($companyIds) - 1)],
                'first_name' => $faker->firstName(),
                'last_name' => $faker->lastName(),
                'phone' => $faker->phoneNumber(),
                'email' => $faker->email(),
                'address' => $faker->address(),
                'created_at' => $faker->dateTimeBetween('-10 years', '-1 year'),
                'updated_at' => $includeUpdatedAt ? $faker->dateTimeBetween('-3 years', '-1 years') : null
            ];

            // if (!$includeUpdatedAt) {
            //     $contact['updated_at'] = $faker->dateTime();
            // }

            $contacts[] = $contact;
        }

        DB::table('contacts')->delete();
        DB::table('contacts')->insert($contacts);
    }
}
