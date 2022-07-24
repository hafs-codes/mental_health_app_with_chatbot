
 <header class="header">

<a href="#" class="logo">MindVibe</a>
<link rel="stylesheet" href="{{asset('/css/home.css')}}">
<nav class="navbar">
    <a href="/">Home</a>
    <a href="/test">Chat</a>
    <a href="/therapist">Therapists</a>
    <a href="/articles">Resources</a>
    @if (Session::has('firstname'))
    @if (Session::has('therapist') and Session::has('approved'))
    <a href="/therapistprofile">Profile</a>
    @elseif(Session::has('student'))
    <a href="/userprofile">Profile</a>
    @endif
    <a>{{session('firstname')}}</a>
    <a href="/logout">Logout</a>
    @else
    <a href="/login">Login</a>
    @endif 
</nav>

<div id="menu-btn" class='bx bx-menu'></div>
</header>

<div>
@yield('content')
</div>