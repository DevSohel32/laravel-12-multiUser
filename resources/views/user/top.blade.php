<a href="{{ route('home') }}">Home</a>
<a href="{{ route('about') }}">About</a>
@if(Auth::guard('web')->check())
<a href="{{ route('user_dashboard')}}">Dashboard</a>
@else
<a href="{{ route('login') }}">login</a>
<a href="{{ route('registration') }}">Register</a>
@endif
