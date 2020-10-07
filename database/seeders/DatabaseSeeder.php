<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        User::truncate();
        Category::truncate();
        Article::truncate();
        DB::table('article_category')->truncate();

        User::flushEventListeners();
        Category::flushEventListeners();
        Article::flushEventListeners();

         User::factory(50)->create();
         Category::factory(15)->create();
         Article::factory(30)->create()->each(
             function($article)
             {
                 $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
                 $article->categories()->attach($categories);
             });
    }
}
