<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Http\Requests\NewsRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    //Display News home.
    public function index()
    {
        $newses = News::orderBy('id', 'desc')->get();   //get all News.

        return view('news.index', compact('newses'));
    }

    //Show the form for creating a new News.
    public function create()
    {
        $categories = Category::all();  //get all Categories

        return view('news.create', compact('categories'));
    }

    //Store a newly created News in storage.
    public function store(NewsRequest $request)
    {
        $input = $request->all();

        //check if user add image or not
        if ($file = $request->file('image'))
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the image
            $file->move('images', $name); //Move the uploaded image to the images directory

            $input['image'] = $name;
        }

        //check if user add video or not
        if ($file = $request->file('video'))
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the image
            $file->move('videos', $name); //Move the uploaded video to the videos directory

            $input['video'] = $name;
        }

        $news = Auth::user()->news()->create($input);

        $news->categories()->syncWithoutDetaching($request->category_id); //Add Article and Categories ID's In Article_Category Table

        return view('news.show')->with('news', $news);
    }

    //Display the specified News.
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    //Show the form for editing the specified Donation.
    public function edit(News $news)
    {
        $categories = Category::all();  //get all Categories

        return view('news.edit', compact('news', 'categories'));
    }

    //Update the specified News in storage.
    public function update(Request $request, News $news)
    {
        $rules =
            [
                'title' => 'required',
                'body' => 'required|max:255',
            ];

        $this->validate($request, $rules);

        $input = $request->all();

        //check if user add image or not
        if ($file = $request->file('image'))
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the image
            $file->move('images', $name); //Move the uploaded image to the images directory

            $input['image'] = $name;
        }

        //check if user add video or not
        if ($file = $request->file('video'))
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the video
            $file->move('videos', $name); //Move the uploaded video to the videos directory

            $input['video'] = $name;
        }

        $news->update($input);

        if($request->category_id)
        {
            $news->categories()->sync($request->category_id); //Add Article and Categories ID's In Article_Category Table
        }

        return view('news.show')->with('news', $news);
    }

    //Remove the specified News from storage.
    public function destroy(News $news)
    {
        $news->delete();

        return redirect()->route('news.index');
    }
}
