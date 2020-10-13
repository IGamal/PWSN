<?php

namespace Database\Factories;

use App\Models\Governorate;
use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

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
            'description' => $this->faker->paragraph(1),
            'requirements' => $this->faker->paragraph(1),
            'salary' => $this->faker->numberBetween($min = 2000, $max = 15000) ,
            'phone'=> $this->faker->e164PhoneNumber,
            'approved' => $approved = $this->faker->randomElement([Job::Aprroved, Job::UnApproved]),
            'governorate_id' => function() { return Governorate::all()->random()->id; },
            'user_id' => function() { return User::all()->random()->id; }
        ];
    }
}
