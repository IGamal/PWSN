<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //show the admin panel.
    public function index()
    {
        return view('admin.dashboard');
    }

    //show all site admins.
    public function admins()
    {
        $admins = User::where('admin', User::ADMIN_USER)->get();

        return view('admin.admins', compact('admins'));
    }

    //show the form to delete for make user an admin.
    public function users()
    {
        return view('admin.users');
    }

    //return the user the admin searched for.
    public function getUser(Request $request)
    {
        $user = User::findOrFail($request->id);

        return response()->json(['code' => 200, 'data' => $user]);
    }

    //Add new admin.
    public function makeadmin(User $user)
    {
        if ($user->isAdmin())  //check if the user is already an admin.
        {
            return response()->json(['code' => 201, 'error' => "User is already an Admin"]);
        }
        if($user->isVerified()) //check if user verified his email or not
        {
            $user->update(['admin' => User::ADMIN_USER]);

            return response()->json(['code' => 200, 'data' => $user, 'success' => "User added to Admins successfully"]);
        }

        return response()->json(['code' => 201, 'error' => "User need to verify his Email first to become an Admin"]);
    }

    //show form to approve donations.
    public function donations()
    {
        $donations = Donation::where('approved', Donation::UnApproved)->get();

        return view('admin.donations', compact('donations'));
    }

    //show form to approve job offers.
    public function jobs()
    {
        $jobs = Job::where('approved', Job::UnApproved)->get();

        return view('admin.jobs', compact('jobs'));
    }
}
