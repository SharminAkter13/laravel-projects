<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'username' => $this->faker->userName,
            'email' => $this->faker->unique()->safeEmail,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'postal_code' => $this->faker->postcode,
            'about_me' => $this->faker->sentence,
            'age' => $this->faker->numberBetween(20, 40),
            'job_title' => $this->faker->jobTitle,
            'location' => $this->faker->city,
            'education' => 'University of Computer Science',
            'profile_image' => 'default.jpg',
        ];
    }
}
