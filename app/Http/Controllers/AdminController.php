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

        return view('admin.Users', compact('user'));
    }

    //Add new admin.
    public function makeadmin(User $user)
    {
        if ($user->isAdmin())  //check if the user is already an admin.
        {
            session()->flash("error", "User is already an Admin");

            return redirect()->route('adminPanel_users');
        }
        if($user->isVerified()) //check if user verified his email or not
        {
            $user->update(['admin' => User::ADMIN_USER]);

            session()->flash("success", "User added to Admins successfully");

            return redirect()->route('adminPanel_users');
        }
        session()->flash("error", 'User need to verify his Email first to become an Admin');

        return redirect()->route('adminPanel_users');
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
