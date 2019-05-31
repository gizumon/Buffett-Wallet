@extends('layouts.app')

@section('content')
<div class="container-fuluid mygray_light">
    <div class="message-block myfont_green">
        <div id="quote" class="font-weight-bold myfont-family_words"></div>
    </div>
</div>
<div class="container-fuluid mygreen_light">
    <div class="inline-button-block">
        <input type="button" onclick="location.href='/list'" class="myfont_green ex-btn-left mybtn_exlg" value="List">
        <input type="button" onclick="location.href='/compare'" class="myfont_green ex-btn-right mybtn_exlg" value="Compare" style="font-size:6vw">
    </div>
    <div class="inline-button-block">
        <input type="button" onclick="location.href=''" class="myfont_green ex-btn-left mybtn_exlg" value="Wallet">
        <input type="button" onclick="location.href=''" class="myfont_green ex-btn-right mybtn_exlg" value="History">
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/home/home.js') }}"></script>
@endsection
