<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Governorate;
use App\Models\Job;
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
        Governorate::truncate();
        Article::truncate();
        Donation::truncate();
        Job::truncate();
        DB::table('article_category')->truncate();
        DB::table('category_donation')->truncate();
        DB::table('category_job')->truncate();


        User::flushEventListeners();
        Category::flushEventListeners();
        Governorate::flushEventListeners();
        Article::flushEventListeners();
        Donation::flushEventListeners();
        Job::flushEventListeners();

         User::factory(50)->create();

         Category::factory(15)->create();
         $this->call(GovernorateSeeder::class);

         Article::factory(30)->create()->each(
             function($article)
             {
                 $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
                 $article->categories()->attach($categories);
             });
        Donation::factory(30)->create()->each(
            function($donation)
            {
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
                $donation->categories()->attach($categories);
            });
        Job::factory(25)->create()->each(
            function($job)
            {
                $categories = Category::all()->random(mt_rand(1,5))->pluck('id');
                $job->categories()->attach($categories);
            });
    }
}
