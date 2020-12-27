<?php

namespace Database\Factories;

use App\Models\Education;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EducationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Education::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->sentence(4);

        return [
            'title' => $title,
            'slug' => str_slug($title),
            'body' => $this->faker->paragraph(1),
            'approved' => $approved = $this->faker->randomElement([Education::Aprroved, Education::UnApproved]),

            'user_id' => function() { return User::all()->random()->id; }
        ];
    }
}
