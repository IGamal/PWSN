<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function() {return User::all()->random()->id;},
            'comment_id' => function() {return Comment::all()->random()->id;},
            'reply_id' => function() {return Reply::all()->random()->id;},
            'like' => $this->faker->randomElement([0,1])
        ];
    }
}
