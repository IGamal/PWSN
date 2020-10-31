<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Donation;
use App\Models\Job;
use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $donations = Donation::latest("ID")->limit(5)->get();
        $articles = Article::latest("ID")->limit(5)->get();
        $newses = News::latest("ID")->limit(5)->get();
        $jobs = Job::latest("ID")->limit(5)->get();
        return view('home', compact('articles', 'newses', 'donations', 'jobs'));
    }
}
