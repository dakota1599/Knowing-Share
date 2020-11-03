<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;

class UserController extends Controller
{
    //
    public function index(){
        return view('users.signin');
    }


    //Signing up for an account.
    public function signup(){
        //Quick validation of all request variables
        session(['method' => 'up']); //This is for toggling which box appears on page.
        request()->validate([
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password1' => 'required|same:password2',
            'secq' => 'required',
            'seca' => 'required'
        ]);

        //Creation of the user if the validation succeeds.
        User::create([
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'password' => request('password1'),
            'forgot_pass_question' => request('secq'),
            'forgot_pass_answer' => request('seca')
        ]);
        session(['method' => 'in']);
        return redirect(route('user.sign'));

    }

    //Signing in.
    public function signin(){
        //Validates that the user inputted correct data.
        session(['method' => 'in']); //This is for toggling which box appears on page.
        request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //Attempts to find the user.
        $user = User::where([
            ['email','=',request('email')],
            ['password','=',request('password')]
        ])->first();

        //If the user is not found, redirect back with error message.
        if($user == null){
            //Logs the failed login attempt
            Log::create([
                'email' => request('email'),
                'successful' => 0
            ]);
            return redirect()->route('user.sign')->with('message','Username or password do not match our records');
        }
        //If user is found, set all session variables.
        else{
            session([
                'name' => $user->name,
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'password' => $user->password,
                'auth' => true,
                'data' => $user
            ]);

            //Logs the successful login attempt
            Log::create([
                'email' => request('email'),
                'successful' => 1
            ]);

            return redirect('/');
        }
    }

    //Signing out.
    public function signout(){
        //Purges all session variables
        session()->flush();
        //Returns to home screen
        return redirect('/');
    }

    //If in the event that a specific user is requested.
    public function profile(User $user){
        //First this checks to see if the user exists or not.
        if($user == null){
            //If not, then it will send them to the regular creators page.
            $users = User::latest()->paginate(9);
            return view('users.index',['users'=>$users]);
        }
        //If the user does exists, the method will check to see if that user is signed in currently.
        if(session('username') != null && session('username') == $user->username){
            //If so, then the user will be directed to the edit version of the profile page.
            $posts = $user->posts()->latest()->paginate(3);
            return view('users.controlprofile',['user' => $user, 'posts' => $posts]);
        }else{
            //Else, they will be directed to the public view profile page.
            $posts = $user->posts()->latest()->paginate(3);
            return view('users.profile', ['user' => $user, 'posts' => $posts]);
        }
    }

    //For viewing all creators
    public function creators(){
        //Gets the most recently added users and paginates them for every 9.
        $users = User::latest()->paginate(9);

        //Returns the view with the users variable passed through.
        return view('users.index',['users' => $users]);
    }

    //Updating user information
    public function update(User $user){
        //Validation of the name and email fields.
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required'
        ]);

        //If cpass is not empty, it will validate ensure that the current password matches the input.
        if(request('cpass') != ""){
            if(request('cpass') == $user->password){
                //Then will validate to ensure npass1 and npass2 match
                request()->validate([
                    'npass1' => 'required|same:npass2'
                ]);
                //It will update the password informmation if all goes well.
                $user->update([
                    'password' => request('npass1')
                ]);
            }else{
                //If the current pass does not match the input, it will return to the page with an error
                return redirect(route('profile.show',$user->username))->with('perror','Incorrect Current Password.');
            }
        }
        //Updates other user information by default.
        $user->update([
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'bio' => request('bio')
        ]);

        //Updates the user information in the session variable.
        session([
            'name' => request('name'),
            'username' => request('username'),
            'email' => request('email'),
            'bio' => request('bio')
        ]);

        //If the method reaches this point, that means all was successful and the user is redirected back to their
        //profile page with a message saying their profile was updated successfully.
        return redirect(route('profile.show',$user->username))->with('message','Profile Updated Successfully');
    }
}
