<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        \App\Models\Company::factory()->count(10)->create()->each(function ($company) {
            $company->contacts()->saveMany(
                \App\Models\Contract::factory()->count(rand(5, 10))->make()
            );
        });
    }
}
