<?php

namespace App\Http\Controllers;

use App\Http\Requests\DonationRequest;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    //Display Articles home.
    public function index()
    {
        $donations = Donation::all();

        return view('donations.index', compact('donations'));
    }

    //Show the form for creating a new Donation.
    public function create()
    {
        $governorates = Governorate::pluck('name', 'id')->all();
        $categories = Category::all();  //get all Categories

        return view('donations.create', compact( 'governorates','categories'));
    }

    //Store a newly created donation in storage.
    public function store(DonationRequest $request)
    {
        $input = $request->all();

        //check if user add image or not
        if ($file = $request->file('image'))
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the image
            $file->move('images', $name); //Move the uploaded image to the images directory

            $input['image'] = $name;
        }

        $input['user_id'] = Auth::id(); //Add user Id

        $donation = Donation::create($input);

        $donation->categories()->syncWithoutDetaching($request->category_id); //Add Article and Categories ID's In Article_Category Table

        return view('donations.show', compact('donation'));
    }

    //Display the specified donation.
    public function show(Donation $donation)
    {
        return view('donations.show', compact('donation'));
    }

    //Show the form for editing the specified donation.
    public function edit(Donation $donation)
    {
        $governorates = Governorate::pluck('name', 'id')->all();
        $categories = Category::all();  //get all Categories

        return view('donations.edit', compact( 'donation', 'governorates','categories'));
    }

    //Update the specified donation in storage.
    public function update(Request $request, Donation $donation)
    {
        $rules =
            [
                'title' => 'required',
                'description' => 'required|max:255',
                'governorate_id' => 'required',
                'phone' => 'required',
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

        $donation->update($input);

        if($request->category_id)
        {
            $donation->categories()->sync($request->category_id); //Add Article and Categories ID's In Article_Category Table
        }

        return view('donations.show', compact('donation'));
    }

    //Remove the specified donation from storage.
    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('donations.index');
    }
}
