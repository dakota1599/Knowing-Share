<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogsController extends Controller
{
    //For viewing the entire log index
    public function index(){
        if(session()->exists('username') && session('username') == 'dakota'){
            $logs = Log::latest()->paginate('10');
            return view('logs.index', ['logs' => $logs]);
        }

        return redirect('/')->with('lperm', 'You do not have permission to view the logs');
    }
}
