<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone'=> $this->faker->e164PhoneNumber,
            'birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'image' => $this->faker->imageUrl($width = 640, $height = 480, 'people'),
            'remember_token' => Str::random(10),
            'verified' => $verified = $this->faker->randomElement([ User::VERIFIED_USER, User::UNVERIFIED_USER]),
            'verification_token' => $verified == User::VERIFIED_USER ? null : User::generateVerificationCode(),
            'admin' => $admin = $this->faker->randomElement([User::ADMIN_USER, User::REGULAR_USER]),
        ];


    }
}
