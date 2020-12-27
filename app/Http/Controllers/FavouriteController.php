<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Donation;
use App\Models\Education;
use App\Models\favourite;
use App\Models\Job;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    //Display all User Favourites.
    public function index()
    {
        //
    }

    //Show a specific item from favourite list.
    public function show(favourite $favourite)
    {
        //
    }

    //Add or delete item from favourite list.
    public function favourite(Request $request)
    {
        if(Auth::user()->favourites()->where('article_id', $request->article_id)->first())
        {
            $favourite = Auth::user()->favourites()->where('article_id', $request->article_id)->first();

            $favourite->delete();

            return response()->json(['code'=>401]);
        }else
        {
            auth::user()->favourites()->create($request->all());

            return response()->json(['code'=>200]);
        }
    }

    public function getfavourite($model)
    {
        if ($model === 'article') {
            $favourites = Auth::user()->favourites()->whereRaw('article_id')->get();

            foreach ($favourites as $favourite) {
                $articles[] = Article::where('id', $favourite->article_id)->get();
            }

            return response()->json(['code' => 200, 'data' => $articles]);
        }
        if ($model === 'donation') {
            $favourites = Auth::user()->favourites()->whereRaw('donation_id')->get();

            foreach ($favourites as $favourite) {
                $donations[] = Donation::where('id', $favourite->donation_id)->get();
            }

            return response()->json(['code' => 201, 'data' => $donations]);
        }
        if ($model === 'news') {
            $favourites = Auth::user()->favourites()->whereRaw('news_id')->get();

            foreach ($favourites as $favourite) {
                $news[] = News::where('id', $favourite->news_id)->get();
            }

            return response()->json(['code' => 202, 'data' => $news]);
        }
        if ($model === 'job') {
            $favourites = Auth::user()->favourites()->whereRaw('job_id')->get();

            foreach ($favourites as $favourite) {
                $jobs[] = Job::where('id', $favourite->job_id)->get();
            }

            return response()->json(['code' => 203, 'data' => $jobs]);
        }
        if ($model === 'education') {
            $favourites = Auth::user()->favourites()->whereRaw('education_id')->get();

            foreach ($favourites as $favourite) {
                $educations[] = Education::where('id', $favourite->education_id)->get();
            }

            return response()->json(['code' => 204, 'data' => $educations]);
        }
    }
}
