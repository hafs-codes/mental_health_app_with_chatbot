<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Nette\Utils\Json;
use Symfony\Component\Console\Input\Input;

class ExampleController extends Controller
{
    //
   

    public function example(Request $request)
    {
        $test ="gdy";
        dd($request);
        return response()->json(['success'=>'Data is successfully added']);
      
        

    }

}
