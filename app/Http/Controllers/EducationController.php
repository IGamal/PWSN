<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EducationController extends Controller
{
    //Display Videos home.
    public function videos()
    {
        $videos = Education::whereRaw('video')->get();

        return view('educations.videos', compact('videos'));
    }

    //Display Books home.
    public function books()
    {
        $books = Education::whereRaw('book')->get();

        return view('educations.books', compact('books'));
    }

    //Show the form for creating a new Education.
    public function create()
    {
        $categories = Category::all();

        return view('educations.create', compact('categories'));
    }

    //Store a newly created Education in storage.
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            'body' => 'required|max:255',
            'category_id' => 'required',
        ];

        $this->validate($request, $rules);

        $input = $request->all();

        if ($file = $request->file('video') && $file = $request->file('book')) //check if user add book and video
        {
            Session()->flash('error','You Can only upload a book or a video');

            return redirect()->back();
        }
        elseif ($file = $request->file('book')) //check if user add book or not
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the book
            $file->move('books', $name); //Move the uploaded book to the books directory

            $input['books'] = $name;
        }
        elseif ($file = $request->file('video')) //check if user add video or not
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the video
            $file->move('videos', $name); //Move the uploaded video to the videos directory

            $input['video'] = $name;
        }
        else
        {
            Session()->flash('error','Please upload a book or a video');

            return redirect()->back();
        }

        $education = Auth::user()->educations()->create($input);

        $education->categories()->syncWithoutDetaching($request->category_id); //Add Education and Categories ID's In Category_Education Table

        return view('educations.show', compact('education'));

    }

    //Display the specified Education.
    public function show(Education $education)
    {
        if($education->video)
        {
            $videos = Education::whereRaw('video')->get();

            return view('educations.videoShow', compact('education', 'videos'));
        }
        elseif ($education->book)
        {
            return view('educations.bookShow', compact('education'));
        }
        else{
            return redirect()->back();
        }
    }

    //Show the form for editing Education.
    public function edit(Education $education)
    {
        $categories = Category::all();  //get all Categories

        return view('educations.edit', compact('education', 'categories'));
    }

    //Update the specified Education.
    public function update(Request $request, Education $education)
    {
        $rules = [
            'title' => 'required',
            'body' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $input = $request->all();


        if ($file = $request->file('book')) //check if user add book or not
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the book
            $file->move('books', $name); //Move the uploaded book to the books directory

            $input['books'] = $name;
        }
        if ($file = $request->file('video')) //check if user add video or not
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the video
            $file->move('videos', $name); //Move the uploaded video to the videos directory

            $input['video'] = $name;
        }

        $education->update($input);

        if($request->category_id)
        {
            $education->categories()->sync($request->category_id); //Add Education and Categories ID's In Category_Education Table
        }

        return redirect()->route('educations.show',compact('education'));
    }

    // Remove the specified Education from storage.
    public function destroy(Education $education)
    {
        if($education->video)
        {
            $education->delete();

            return redirect()->route('videos');
        }
        elseif ($education->book)
        {
            $education->delete();

            return redirect()->route('books');
        }
        else{
            return redirect()->back();
        }
    }
}
