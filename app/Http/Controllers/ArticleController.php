<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //Display Articles home.
    public function index()
    {
        $articles = Article::all(); //get all Articles.

        return view('articles.index', compact('articles'));
    }

    //Show the form for creating a new Article.
    public function create()
    {
        $categories = Category::all();  //get all Categories

        return view('articles.create', compact('categories'));
    }

    //Store a newly created Article in storage.
    public function store(ArticleRequest $request)
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

        $input['user_id'] = Auth::id(); //Add user Id

        $article = Article::create($input);

        $article->categories()->syncWithoutDetaching($request->category_id); //Add Article and Categories ID's In Article_Category Table

        return view('articles.show')->with('article', $article);
    }

    //Display the specified Article.
    public function show(Article $article)
    {
        return view('articles.show')->with('article', $article);
    }

    //Show the form for editing Article.
    public function edit(Article $article)
    {
        $categories = Category::all();  //get all Categories

        return view('articles.edit', compact('article', 'categories'));
    }

    //Update the specified Article.
    public function update(Request $request, Article $article)
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
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the image
            $file->move('videos', $name); //Move the uploaded video to the videos directory

            $input['video'] = $name;
        }

        $article->update($input);

        if($request->category_id)
        {
            $article->categories()->sync($request->category_id); //Add Article and Categories ID's In Article_Category Table
        }

        return view('articles.show')->with('article', $article);
    }

    // Remove the specified Article from storage.
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('articles.index');
    }
}
