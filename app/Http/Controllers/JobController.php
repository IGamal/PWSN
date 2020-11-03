<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Category;
use App\Models\Governorate;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    //Display Jobs home.
    public function index()
    {
        $jobs = Job::where('approved', Job::Aprroved)->orderBy('id', 'desc')->get();

        return view('jobs.index', compact('jobs'));
    }

    //Show the form for creating a new Job.
    public function create()
    {
        $governorates = Governorate::pluck('name', 'id')->all();
        $categories = Category::all();  //get all Categories

        return view('jobs.create', compact( 'governorates','categories'));
    }

    //Store a newly created Job in storage.
    public function store(JobRequest $request)
    {
        $input = $request->all();

        $input['user_id'] = Auth::id(); //Add user Id

        $job = Job::create($input);

        $job->categories()->syncWithoutDetaching($request->category_id); //Add Job and Categories ID's In Category_job Table

        session()->flash("success", "Your Job Offer added successfully and waiting for an Admin approval");

        return view('jobs.show', compact('job'));
    }

    //Display the specified Job.
    public function show(Job $job)
    {
        if($job->approved === Job::Aprroved)
        {
            return view('jobs.show', compact('job'));
        }

        return redirect()->back();
    }

    //Show the form for editing the specified Donation.
    public function edit(Job $job)
    {
        $governorates = Governorate::pluck('name', 'id')->all();
        $categories = Category::all();  //get all Categories

        return view('jobs.edit', compact( 'job', 'governorates','categories'));
    }

    //Update the specified Job in storage.
    public function update(Request $request, Job $job)
    {
        $rules =
            [
                'title' => 'required',
                'description' => 'required|max:255',
                'requirements' => 'required|max:255',
                'salary' => 'required',
                'governorate_id' => 'required',
                'phone' => 'required',
            ];

        $this->validate($request, $rules);

        $input = $request->all();
        $input['approved'] = Job::UnApproved;

        $job->update($input);

        if($request->category_id)
        {
            $job->categories()->sync($request->category_id); //Add Job and Categories ID's In Category_job Table
        }

        session()->flash("success", "Your Job Offer edited successfully and waiting for an Admin approval");

        return view('jobs.show', compact('job'));
     }

    //Remove the specified Job from storage.
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('jobs.index');
    }

    //update approved column.
    public function approve(Job $job)
    {
        $job->update(['approved' => Job::Aprroved]) ;

        session()->flash("success", "Job Offer approved successfully");

        return redirect()->back();
    }
}
