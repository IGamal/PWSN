<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Donation;
use App\Models\Education;
use App\Models\Job;
use App\Models\News;
use App\Models\Save;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Save::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function() { return User::all()->random()->id; },
            'article_id'  => $this->faker->randomElement([null, null, null, null, function() { return Article::all()->random()->id; }]),
            'news_id'     => $this->faker->randomElement([null, null, null, null, function() { return News::all()->random()->id; }]),
            'donation_id' => $this->faker->randomElement([null, null, null, null, function() { return Donation::all()->random()->id; }]),
            'education_id' => $this->faker->randomElement([null, null, null, null, function() { return Education::all()->random()->id; }]),
            'job_id'      => $this->faker->randomElement([null, null, null, null, function() { return Job::all()->random()->id; }]),
        ];
    }
}
