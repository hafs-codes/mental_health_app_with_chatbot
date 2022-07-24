<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QAController;
use App\Http\Controllers\AdminController;



use App\Models\TherapistInfo;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    $posts = TherapistInfo::all();
  return view('home', ['posts' => $posts]);
    
});

Route::get('/testhafsatwo', function () {
  
  return view('testhafsatwo');
    
});

Route::get('/home', function () {
    $posts = TherapistInfo::all();
    return view('home', ['posts' => $posts]);
});

// 

Route::get('/regtherapist', function () {
    return view('regtherapist');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/test', function () {
    return view('test');
});
Route::get('/testhafsa', function () {
    return view('testhafsa');
});

Route::get('/logintherapist', function () {
    return view('logintherapist');
});

Route::get('/adminlogin', function () {
    return view('adminlogin');
});

Route::get('/articles', function () {
    return view('articles');
});

Route::get('/register', function () {
    return view('registration');
});

Route::get('/therapistprofile', function () {
    return view('therapistprofile');
});

Route::get('/userprofile', function () {
    $studentemail=session('email');
    $select = DB::select('select * from therapy_sessions where studentemail = :studentemail', ['studentemail' =>   $studentemail]);
    return view("userprof")->with('data',$select);
    
});

Route::get('/chat', function () {
    return view('chat');
});

Route::get('/test_therapist', function () {
    return view('test_therapist');
});


Route::post('/login',[StudentsController::class,'login'])->name('login');

Route::post('/update',[StudentsController::class,'update'])->name('update');

Route::resource('students',StudentsController::class);


// Route::match(['get', 'post'], '/botman', [\App\Http\Controllers\BotmanController::class,'handle']);
Route::get('/fetch',[QAController::class, 'fetch']);
Route::get('/logout',[HomeController::class, 'logout'])->name('logout');
// Route::get('/fetchtest',[QAController::class, 'fetchtest']);
Route::post('/example',[ ExampleController::class, 'example'])->name("example");
Route::post('/example',[ExampleController::class,'example']);


Route::get('/logout',[HomeController::class, 'logout'])->name('logout');


// ADMIN
Route::get('/admintherapists',[AdminController::class, 'showtherapists'])->name('pendingtherapists');
Route::get('/download/{file?}',[AdminController::class, 'download'])->name('download');
Route::get('/approve/{email?}',[AdminController::class, 'approve'])->name('approve');
Route::get('/reject/{email?}',[AdminController::class, 'reject'])->name('reject');
Route::get('/delete/{email?}',[AdminController::class, 'delete'])->name('delete');
Route::post('/adminlogin',[AdminController::class,'adminlogin'])->name('adminlogin');
Route::get('/admin', function () {
    return view('admindashboard');
});


// THERAPIST
Route::get('/therapistdash', function () {
    return view('therapistdashboard');
});
Route::get('/therapistprofile',[HomeController::class, 'therapistprofile'])->name('therapistprofile');
Route::get('/therapysessions',[HomeController::class, 'therapysessions'])->name('therapysessions');

Route::post('/uploadimage/{email?}',[TherapistController::class,'uploadimage'])->name('uploadimage');
Route::post('/bio',[TherapistController::class,'bio'])->name('bio');
Route::post('/logintherapist',[TherapistController::class,'login'])->name('logintherapist');
Route::resource('therapists',TherapistController::class);

Route::post('/requestsession{temail?}',[TherapistController::class,'requestsession'])->name('requestsession');

Route::get('/therapist',[TherapistController::class, 'therapist'])->name('therapist');

// THERAPIST SESSIONS 
Route::get('/approvesessions/{email?}',[TherapistController::class, 'approvesessions'])->name('approvesessions');
Route::get('/rejectsessions/{email?}',[TherapistController::class, 'rejectsessions'])->name('rejectsessions');
Route::get('/deletesessions/{themail?}',[TherapistController::class, 'deletesessions'])->name('deletesessions');



Route::post('/chatbot',function(){
    if(Request::ajax()){
      
        $test = Request::input('firstname');
      
        $response = Http::withHeaders([
 
            "Authorization"=> "Token 403a199d4628b2185f70932f3f2bcbd5d578a2b1"
          ])->post("https://api.nlpcloud.io/v1/roberta-base-squad2/question", [
            "context" => "You are sad because I believe you are not satisfied with your life altogether. If you are sad you should find the reason for youre sadness. Mental illnesses are health conditions that disrupt a persons thoughts, emotions, relationships, and daily functioning. They are associated with distress and diminished capacity to engage in the ordinary activities of daily life. Mental illnesses fall along a continuum of severity: some are fairly mild and only interfere with some aspects of life, such as certain phobias. On the other end of the spectrum lie serious mental illnesses, which result in major functional impairment and interference with daily life. These include such disorders as major depression, schizophrenia, and bipolar disorder, and may require that the person receives care in a hospital. It is important to know that mental illnesses are medical conditions that have nothing to do with a persons character, intelligence, or willpower. Just as diabetes is a disorder of the pancreas, mental illness is a medical condition due to the brains biology. Similarly to how one would treat diabetes with medication and insulin, mental illness is treatable with a combination of medication and social support. These treatments are highly effective, with 70-90 percent of individuals receiving treatment experiencing a reduction in symptoms and an improved quality of life. With the proper treatment, it is very possible for a person with mental illness to be independent and successful.There are various kinds of suffering the physical and the various psychological movements of suffering the ordinary pains through disease, old age, ill-health, bad diet and so on, and the enormous field of psychological suffering.All children feel low or down at times, it’s a natural part of growing up. But these emotions can be worrisome when felt intensely over long periods of time, particularly if they affect your child’s social, family and school life.Although it's hard for anyone to feel optimistic when theyre depressed, depression can be treated and there are things you can do to help your child feel better.Depression is one of the most common types of mental health conditions and often develops alongside anxiety.Depression can be mild and short-lived or severe and long-lasting. Some people are affected by depression only once, while others may experience it multiple times.Depression can lead to suicide, but this is preventable when appropriate support is provided. It’s important to know that much can be done to help young people who are thinking about suicide.Depression can happen as a reaction to something like abuse, violence in school, the death of someone close or family problems like domestic violence or family breakdown. Someone might get depressed after being stressed for a long time. It can also run in the family. Sometimes we may not know why it happens.Depression can show up in children and adolescents as prolonged periods of unhappiness or irritability. It is quite common among older children and teenagers, but often goes unrecognized.Some children might say they feel unhappy or sad. Others might say they want to hurt or even kill themselves. Children and adolescents who experience depression are at greater risk of self-harm, so such responses should always be taken seriously.Just because a child seems sad, it doesn't necessarily mean they have depression. But if the sadness becomes persistent or interferes with normal social activities, interests, schoolwork or family life, it may mean they need support from a mental health professional.Remember, only a doctor or a mental health professional can diagnose depression, so don’t hesitate to ask your health-care provider for advice if you are worried about your child. Happiness is feeling that you have been honest with yourself and those around you, a feeling that you have done the best you could both in your personal life and in your work, and the ability to love others.Symptoms of anxiety include Feeling nervous, restless or tense, Having a sense of impending danger, panic or doom, Having an increased heart rate, Breathing rapidly. You may have insomnia if you lie awake at night, wake up early and cannot go back to sleep and you still feel tired after waking up. If you find it hard to nap during the day even though you're tired you may have a sleep disorder.You may know you have depression if you have drastic changes in sleep, appetite, energy level, concentration, daily behaviour or self-esteem. Depression can also be associated with thoughts of suicide.Chronic insomnia can be dangerous because it can increase the likelihood of some serious diseases and illnesses, including: Heart attack. Stroke.You may have depression if you have suicidal thoughts. Depression can be dangerous because you may have a great tendency of self-harm.You should treat depression by seeing a therapist and being self-aware. You shoud treat anxiety by finding the causes of your anxiety or seeing a therapist. Yes, you can treat insomnia naturally through exercise,keeping cool and to go dark before bed. ",
            "question" =>  $test

        ]);
        // $response=Response::json($response);
        return  $response['answer'];

    }
});



// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('test', function () {
//     return view('test');
// });
// Route::get('ajax',function() {
//     return view('message');
//     });
    
//     Route::post('/getmsg',[ AjaxController::class, 'index']);
    

//     Route::get('/getRequest',function(){
//         if(Request::ajax()){
//             return "getRequest has loades succesfully";
//         }
//     });


  