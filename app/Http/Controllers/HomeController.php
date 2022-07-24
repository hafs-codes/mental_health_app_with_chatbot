<?php

namespace App\Http\Controllers;

use App\Models\Therapists;
use App\Models\TherapistInfo;
use App\Http\Requests\TherapistFormRequest;
use Session;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    //
    public function home()
    {
        return view('home');
    }

    public function therapistprofile()
    {
        return view("therapistprofile");
    }
    
    public function therapysessions()
    {
      
        $therapistemail=session('email');
        $select = DB::select('select * from therapy_sessions where therapistemail = :therapistemail', ['therapistemail' =>   $therapistemail]);
       
        return view("therapysessions")->with('data',$select);
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return view('home');
    }
}
