<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    //Show the form for creating a new resource.
    public function create()
    {
        return view('users.create');
    }

    //Store a newly created new user.
    public function store(UserRequest $request)
    {
        $input = $request->all();

        //check if user add image or not
        if ($file = $request->file('image'))
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the image
            $file->move('images', $name); //Move the image to the images directory

            $input['image'] = $name;
        }

        $input['password'] = bcrypt($request->password); // Encrypt the password
        $input['verified'] = User::UNVERIFIED_USER;
        $input['verification_token'] = User::generateVerificationCode(); //generate Verification code to verify his Email Address
        $input['admin'] = User::REGULAR_USER; //Make user not an admin

        User::create($input); //Create new User

        //Email sent to the user to verify his Email Address

        Session()->flash('success','user '. $input['first_name'] . ' has been Added successfully');

        return redirect('/home');
    }

    //Display user page
    public function show($id)
    {
        //
    }

    //Show the form for editing user information.
     public function edit(User $user)
    {

        return view('users.edit')->with('user', $user);
    }

    //Update the specified user information.
     public function update(Request $request, User $user)
    {
        $input = $request->all();

        //validate user input
        $rules=[
            'first_name' => 'required|string|max:30',
            'last_name' => 'required|string|max:100',
            'birthday' => 'date',
        ];
        $this->validate($request, $rules);

        //check if user edit image or not
        if ($file = $request->file('image'))
        {
            $name = time() . '_' . rand(0, 1000) . '.' . $file->getClientOriginalExtension() ; //rename the image
            $file->move('images', $name); //Move the image to the images directory

            $input['image'] = $name;
        }

        $user->update($input); //Update user Information

        return redirect('/home');
    }

    //softDelete user information
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/home');
    }

    //verify user Email Address
    public function verify($token)
    {
        $user = User::where('verification_token', $token)->firstorfail();

        $user->verified = User::VERIFIED_USER;
        $user->verification_token = null;
        $user->email_verified_at = now();
        $user->save();

        return redirect('/home');
    }

    public function resend($token)
    {
        return $token;
    }
}
