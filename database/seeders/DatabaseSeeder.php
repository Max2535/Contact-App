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
        $users = \App\Models\User::factory()->count(5)->create();

        $users->each(function ($user) {

            $companies = $user->companies()->saveMany(
                \App\Models\Company::factory()->count(rand(2, 5))->make()
            );

            $companies->each(function ($company) use ($user) {
                $company->contacts()->saveMany(
                    \App\Models\Contract::factory()->count(rand(5, 10))
                    ->make()
                    ->map(function($contract) use ($user){
                        $contract->user_id = $user->id;
                        return $contract;
                    })    
                );
            });

        });
    }
}
