<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Students;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use App\Http\Requests\StudentsFormRequest;

class StudentsController extends Controller
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
        return view("registration");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentsFormRequest $request)
    {
    
        $data = $request->validated();
       $st= Students::create($data);

      
       if ($st) {
        $user = Students::where('email', '=', $request->email)->first();

            $request->session()->put('id', $user->id);
            $request->session()->put('firstname', $user->firstname);
            $request->session()->put('lastname', $user->lastname);
            $request->session()->put('email', $user->email);
            $request->session()->put('phonenumber', $user->phonenumber);
            $request->session()->put('password', $user->password);
            session()->put('student', $user->email);

            return redirect('/');
        } 

        // return redirect()->route('guitars.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("userprof")-> with('user', auth()->user());

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user= Students::where('email','=',$request->email)->first();

        $user->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phonenumber' => $request->phonenumber,
            'password' => $request->password,

        ]);

        session()->flash('success', 'UserProfile update successful');

        return redirect()->back();

    }

    public function login(Request $request)
    {
    $request->validate([
    'email'=>'required',
    'password'=>'required'
    
    ]);
        $user= Students::where('email','=',$request->email)->first();
        if($user)
        {
            if (Hash::check($request->password, $user->password)) {
                // $returns = Returns::where('email', '=', $user->email)->first();
             
                $request->session()->put('firstname', $user->firstname);
                $request->session()->put('email', $user->email);
                $request->session()->put('lastname', $user->lastname);
                $request->session()->put('email', $user->email);
                $request->session()->put('phonenumber', $user->phonenumber);
                $request->session()->put('password', $user->password);
                session()->put('student', $user->email);

              return view('home');
            }
            else{
                echo '<script>alert("Password Incorrect")</script>';
                 return back();

            }
        }
        else
        {
            echo '<script>alert("User Does Not Exist")</script>';
            return back();

        }
    }

    // }
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
