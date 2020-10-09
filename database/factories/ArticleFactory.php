<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

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
            'image' => $this->faker->imageUrl($width = 640, $height = 480, 'abstract'),
            'approved' => $approved = $this->faker->randomElement([Article::Aprroved, Article::UnApproved]),
            'user_id' => function() { return User::all()->random()->id; }
        ];
    }
}
