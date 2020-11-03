<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMe;

class ContactController extends Controller
{
    //
    public function contact(){
        request()->validate([
            'email' => 'required|email'
        ]);

        Mail::to(request('email'))->send(new ContactMe());

        return redirect('/contact')->with('message','Email Sent!');
    }

    public function show(){

        return view('contact');
    }
}
