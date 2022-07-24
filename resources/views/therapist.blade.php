<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapist</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="{{asset('/css/therapist.css')}}">

</head>
@extends('navbar')

@section('content')
<body>
<section id="doctors" class="doctors">

<h1 class="heading">our <span>Therapists</span></h1>


<div class="box-container">
    
@if($posts)
@foreach($posts as $post)
<div class="box">

@if ($post->images)
<?php $images = $post->images;?>

<img alt="Profile Image Not Available" src="{{url('/storage/timage/'.$images)}}">
@else
<h2>Therapist has no image yet :(</h2>
@endif
        <h3>{{ $post->firstname }}</h3>
        <p>  {{ $post->bio }}
        </p>
        @if (Session::has('sessionrequested'))
        <button type="submit" class="btn">Appointment Requested <span class="bx bx-calendar-check"></span></button>
        <?php session()->forget('sessionrequested'); ?>
        @else
        <?php $temail =  $post->email ?>
        
        <form action="{{route('requestsession',$temail)}}" method="post">
                @csrf
        <button type="submit" class="btn">Make appointment <span class="bx bx-calendar-check"></span></button>
        </form>
        @endif
    </div>
    @endforeach
</div>
</section>
@else
    <section class="content">
            <div class="t-profile">
                <div class="t-profile_img">
                    <img src="" alt="">
                </div>
                <div class="t-profile_info">
                    <h1 class="t_profile_title">No Therapist</h1>
                    <p class="t-profile_text">
                    </p>
                
                </div>
            </div>

        
    </section>    
    
@endif
</body>
</html>
@endsection
