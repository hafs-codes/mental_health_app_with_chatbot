<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class QAController extends Controller
{

public function fetch(Request $request)
{

   $test = $request->get('lastUserMessage');

 // echo $test;
  
  // $question ="What did the french president say";
  // $data = Input::get('question');
    $response = Http::withHeaders([
     
        "Authorization"=> "Token 403a199d4628b2185f70932f3f2bcbd5d578a2b1"
      ])->post("https://api.nlpcloud.io/v1/roberta-base-squad2/question", [
        "context" => "Mental illnesses are health conditions that disrupt a persons thoughts, emotions, relationships, and daily functioning. They are associated with distress and diminished capacity to engage in the ordinary activities of daily life. Mental illnesses fall along a continuum of severity: some are fairly mild and only interfere with some aspects of life, such as certain phobias. On the other end of the spectrum lie serious mental illnesses, which result in major functional impairment and interference with daily life. These include such disorders as major depression, schizophrenia, and bipolar disorder, and may require that the person receives care in a hospital. It is important to know that mental illnesses are medical conditions that have nothing to do with a persons character, intelligence, or willpower. Just as diabetes is a disorder of the pancreas, mental illness is a medical condition due to the brains biology. Similarly to how one would treat diabetes with medication and insulin, mental illness is treatable with a combination of medication and social support. These treatments are highly effective, with 70-90 percent of individuals receiving treatment experiencing a reduction in symptoms and an improved quality of life. With the proper treatment, it is very possible for a person with mental illness to be independent and successful.",
        "question" =>  $test
        
    ]);
    
    
    // return response()->json($data);
    return $response['answer'];
    
    
}

}

