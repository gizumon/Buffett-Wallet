@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container_import">
        <h1 class="myfont text-center font-weight-bold">Welcome</h1>
        <form method="POST" action="{{ route('login') }}">
            <input type="text" placeholder="Username">
            <input type="password" placeholder="Password">
            <button type="submit" id="login-button">Login</button>
        </form>
    </div>
    
    <ul class="bg-bubbles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>
@endsection