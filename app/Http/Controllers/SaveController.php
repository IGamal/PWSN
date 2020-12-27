<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Donation;
use App\Models\Education;
use App\Models\Job;
use App\Models\News;
use App\Models\Save;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveController extends Controller
{
    //Display all User Saves.
    public function index()
    {
        //
    }

    //Show a specific item from save list.
    public function show(favourite $favourite)
    {
        //
    }

    //Add or delete item from favourite list.
    public function save($model, $id)
    {
        $model_id = $model.'_id';

        if(Auth::user()->saves()->where($model_id, $id)->first())
        {
            $save = Auth::user()->saves()->where($model_id, $id)->first();

            $save->delete();

            return response()->json(['code'=>401]);
        }
        else
        {
            auth::user()->saves()->create([$model_id => $id]);

            return response()->json(['code'=>200]);
        }
    }

    public function getsaved($model)
    {
        if ($model === 'article') {
            $saves = Auth::user()->saves()->whereRaw('article_id')->get();

            foreach ($saves as $save) {
                $articles[] = Article::where('id', $save->article_id)->get();
            }

            return response()->json(['code' => 200, 'data' => $articles]);
        }
        if ($model === 'donation') {
            $saves = Auth::user()->saves()->whereRaw('donation_id')->get();

            foreach ($saves as $save) {
                $donations[] = Donation::where('id', $save->donation_id)->get();
            }

            return response()->json(['code' => 201, 'data' => $donations]);
        }
        if ($model === 'news') {
            $saves = Auth::user()->saves()->whereRaw('news_id')->get();

            foreach ($saves as $save) {
                $news[] = News::where('id', $save->news_id)->get();
            }

            return response()->json(['code' => 202, 'data' => $news]);
        }
        if ($model === 'job') {
            $saves = Auth::user()->saves()->whereRaw('job_id')->get();

            foreach ($saves as $save) {
                $jobs[] = Job::where('id', $save->job_id)->get();
            }

            return response()->json(['code' => 203, 'data' => $jobs]);
        }
        if ($model === 'education') {
            $saves = Auth::user()->saves()->whereRaw('education_id')->get();

            foreach ($saves as $save) {
                $educations[] = Education::where('id', $save->education_id)->get();
            }

            return response()->json(['code' => 204, 'data' => $educations]);
        }
    }
}
