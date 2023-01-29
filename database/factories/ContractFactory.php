<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use \App\Models\Company;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contract>
 */
class ContractFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name'=>$this->faker->firstName,
            'last_name'=>$this->faker->lastName,
            'phone'=>$this->faker->phoneNumber,
            'email'=>$this->faker->email,
            'address'=>$this->faker->address,            
            'company_id'=>Company::pluck('id')->random(),
            'user_id' => Company::find(Company::pluck('id')->random())->user_id
            //"user_id" => User::factory(),
        ];
    }
}
