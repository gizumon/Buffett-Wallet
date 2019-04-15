@extends('layouts.app')

@section('content')
<div class="wrapper">
    <div class="container_import">
        <h1 class="myfont text-center font-weight-bold">Welcome</h1>
        <form method="POST" action="{{ route('login') }}">
        <!-- CSRF保護 -->
        @csrf

            <input id="email" type="email" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
            <input id="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
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