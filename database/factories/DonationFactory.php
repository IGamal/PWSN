<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(3, $variableNbWords = true);

        return [
            'title' => $title,
            'slug' => str_slug($title),
            'image' => $this->faker->imageUrl($width = 640, $height = 480, 'abstract'),
            'description' => $this->faker->paragraph(1),
            'phone'=> $this->faker->e164PhoneNumber,
            'approved' => $approved = $this->faker->randomElement([Donation::Aprroved, Donation::UnApproved]),
            'governorate_id' => function() { return Governorate::all()->random()->id; },
            'user_id' => function() { return User::all()->random()->id; }
        ];
    }
}
