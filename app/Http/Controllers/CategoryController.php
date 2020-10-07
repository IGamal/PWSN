<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //Display all Category.
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('category'));
    }

    //Store a newly created category.
    public function store(Request $request)
    {
        $rules =
            [
                'name' => 'required ',
                'description' => 'required',
            ];

        $this->validate($request, $rules); //Validate user input

        $input = $request->all();

        $input['user_id'] = Auth::id(); //Add user Id

        Category::create($input);

        return redirect()->route('categories.index');
    }

    //Show the form for editing category.
    public function edit(Category $category)
    {
        return view('categories.edit',compact('category'));
    }

    //Update the specified category.
    public function update(Request $request, Category $category)
    {
        $rules =
            [
                'name' => 'required ',
                'description' => 'required',
            ];

        $this->validate($request, $rules); //Validate user input

        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    //Remove the specified categories from storage.
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
