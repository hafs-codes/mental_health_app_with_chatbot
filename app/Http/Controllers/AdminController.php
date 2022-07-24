<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Therapists;
use App\Models\TherapistInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AdminFormRequest;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admindashboard");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminFormRequest $request)
    {
        //
    }

    public function adminlogin(Request $request)
    {
        $request->validate([
        'email'=>'required',
        'password'=>'required'
        
        ]);

        $user= Admin::where('email','=',$request->email)->first();
        if($user)
        {
            if (Hash::check($request->password, $user->password)) {
             
                $request->session()->put('firstname', $user->firstname);
                $request->session()->put('email', $user->email);
                $request->session()->put('lastname', $user->lastname);
                $request->session()->put('email', $user->email);
                $request->session()->put('phonenumber', $user->phonenumber);
                $request->session()->put('password', $user->password);
    

              return view('admindashboard');
            }
            else{
                echo '<script>alert("Password Incorrect")</script>';
                 return back();

            }
        }
        else
        {
            echo '<script>alert("Admin not Registered")</script>';
            return back();

        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        $select = DB::select('select * from admin');
        return view ('')->with('data',$select);
    }
    public function showtherapists(Admin $admin)
    {
        //
        $select = DB::select('select * from therapists');
        return view ('admintherapists')->with('data',$select);
    }

    public function download($file){
        $file_path = public_path('storage/myfile/cv/'.$file);
        return response()->download($file_path);
    }
    public function approve(Request $request,$email)
    {
        Therapists::where('email', $email)->update(['approval' =>"approved"]);
        $therapist=Therapists::where('email', $email)->first();
        session()->put('therapist', $email);
        session()->put('approved', "approved");
        session()->put('created_at', $therapist->created_at);
        session()->put('updated_at', $therapist->updated_at);
        $bio = TherapistInfo::where('email', '=', $email)->first();
                    
        if ($bio) {
            session()->put('bio', $bio->bio);
            session()->put('images', $bio->images);
        }
        else{
            TherapistInfo::create([
                'firstname'   =>   $therapist->firstname,
               'email'=>$email,

            ]);
        }
        return back();
    }
    public function reject(Request $request,$email)
    {
        Therapists::where('email', $email)->update(['approval' =>"rejected"]);
       return back();
    }
    public function delete(Request $request,$email)
    {
        Therapists::where('email', $email)->delete();
        TherapistInfo::where('email', $email)->delete();
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
