<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            
            'name' => $this->faker->name('male'),
            'email' => $this->faker->safeEmail,
            'phone_number' => $this->faker->phoneNumber,
            'password' => Hash::make(55555),
            'email_verified_at' => Carbon::now()

        ];
    }
}
