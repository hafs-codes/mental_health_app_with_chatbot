<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Therapists;
use App\Models\TherapistInfo;
use App\Models\TherapySessions;
use App\Models\Students;
use App\Http\Requests\TherapistFormRequest;
use Session;
use Hash;


class TherapistController extends Controller
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
    public function create(Request $request)
    {
        //
        $one=$request->randomone;

        return "hdgfe";

    }

    public function therapist()
    {
        $posts = TherapistInfo::all();
     
        return view('therapist', ['posts' => $posts]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TherapistFormRequest $request)
    {
        //
        $data = $request->validated();

        if ($request->hasFile('myfile')) {
            $destination_path = "public/myfile/cv";
            $image = $request->file("myfile");
            $image_name = $image->getClientOriginalName();
            $path = $request->file("myfile")->storeAs($destination_path, $image_name);

            $data["myfile"] = $image_name;
        }
        $success = Therapists::create($data);
        if ($success) {
            $user = Therapists::where('email', '=', $request->email)->first();
            $request->session()->put('firstname', $user->firstname);
            $request->session()->put('lastname', $user->lastname);
            $request->session()->put('password', $user->password);
            $request->session()->put('phonenumber', $user->phonenumber);
            $request->session()->put('email', $user->email);
            session()->put('therapist', $user->email);


            echo '<script>alert("Application Succesful. Wait for further Communication Via email")</script>';
            return redirect("/home")->with('message', 'Your registration has been received, we will get back to you soon.');
        } else {
            echo '<script>alert("Application failed. Try again.")</script>';
            return view("regtherapist");
        }
       

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idapproval
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //upload

    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'

        ]);

        $user = Therapists::where('email', '=', $request->email)->first();
        $accept = "approved";
        if ($user) {
            $approved = Therapists::where('approval', '=', $accept)->first();
            if ($approved) {
                if (Hash::check($request->password, $user->password)) {

                    $bio = TherapistInfo::where('email', '=', $request->email)->first();
                    
                    if ($bio) {
                        session()->put('bio', $bio->bio);
                        session()->put('images', $bio->images);
                    }
                    else{
                        TherapistInfo::create([
                            'firstname'   =>   $user->firstname,
                           'email'=>$request->email,
            
                        ]);
                    }
                    $request->session()->put('id', $user->id);
                    $request->session()->put('phonennumber', $user->phonenumber);
                    $request->session()->put('timage', $user->timage);
                    $request->session()->put('lastname', $user->lastname);
                    $request->session()->put('firstname', $user->firstname);
                    $request->session()->put('email', $user->email);
                    session()->put('created_at', $user->created_at);
                    session()->put('updated_at', $user->updated_at);
                    session()->put('therapist', $user->email);
                    session()->put('approved', "approved");
                    return view("home");
                } else {
                    return back()->with('fail', 'Password does not match');
                }
            } else {
                echo '<script>alert("Please Wait for youre application to be approved,you will receive an email")</script>';
                return view('home');
            }
        } else {
            return back()->with('fail', 'User Does Not Exist');
        }
    }


    public function bio(Request $request)
    {

        $validated = $request->validate([

            'bio'   =>   'required',
        ]);

        if ($validated) {
            $email = session('email');
          
            TherapistInfo::where('email', $email)->update(['bio' =>  $request->bio]);
            $bio = TherapistInfo::where('bio', '=', $request->bio)->first();
           
            if ($bio) {
                session()->put('bio', $bio->bio);
             
               return redirect('/therapistprofile');
            }
           
        }
      
        
        return redirect('/therapistprofile');
    }
    public function requestsession(Request $request,$temail)
    {
        session()->put('sessionrequested', $temail);

        $student = Students::where('email', '=', session("email"))->first();
        $therapist = Therapists::where('email', '=', $temail)->first();
        TherapySessions::create([
            'studentname'   =>   $student->firstname,
           'therapistname'=> $therapist->firstname,
           'studentphonenumber'   =>    $student->phonenumber,
           'therapistphonenumber'=> $therapist->phonenumber,
           'studentemail'   =>    session("email"),
           'therapistemail'=>$temail,
            'date'=> date('Y-m-d H:i:s'),

        ]);

        return back();
    }

public function approvesessions(Request $request,$email){

    TherapySessions::where('therapistemail', $email)->update(['completion' =>"approved"]);;
    return back();
}
public function deletesessions(Request $request,$themail){

    TherapySessions::where('therapistemail', $themail)->delete();
      
    return back();
    
}
public function rejectsessions(Request $request,$email){

    
    TherapySessions::where('therapistemail', $email)->update(['completion' =>"rejected"]);
    return back();
}



    public function uploadimage(Request $request, $email)
    {
       

        $validated = $request->validate([
            'timage' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
        ]);

        if ($validated) {
        }
        if ($request->hasFile('timage')) {
            $destination_path = "public/timage";
            $image = $request->file("timage");
            $image_name = $image->getClientOriginalName();
            $path = $request->file("timage")->storeAs('', $image_name);
            $data["timage"] = $image_name;
        }
      
        TherapistInfo::where('email', $email)->update(['images' => $path]);
        $uploadsuccess =TherapistInfo::where('images', '=', $path)->first();
       if($uploadsuccess){
        session()->put('images', $image_name);
       }
       
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //s
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
