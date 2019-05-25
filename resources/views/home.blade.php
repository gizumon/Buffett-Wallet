@extends('layouts.app')

@section('content')
<div class="container-fuluid mygray_light">
        <div class="row myfield_large myfont_green item-center-block no_margin">
            <div id="quote" class="mx-auto text-center col-sm-6 font-weight-bold myfont-family_words"></div>
        </div>
</div>
<div class="container-fuluid">
    <div class="row mygreen_light no_margin">
        <div class="col-sm-2 myfield_midium"></div>
        <div class="col-sm-4 mygreen_light myfield_midium p-3">
                <input type="button" onclick="location.href='/list'" class="mybtn_exlg btn-secondary font-weight-bold myfont_green text-center" value="List">
        </div>
        <div class="col-sm-4 myfield_midium p-3">
                <input type="button" onclick="location.href='/compare'" class="mybtn_exlg btn-secondary font-weight-bold myfont_green text-center" value="Compare" style="font-size:6vw">
        </div>
        <div class="col-sm-2 myfield_midium"></div>
    </div>
    <div class="row mygreen_light no_margin">
        <div class="col-sm-2 myfield_midium"></div>
        <div class="col-sm-4 myfield_midium p-3">
                <input type="button" onclick="location.href=''" class="mybtn_exlg btn-secondary font-weight-bold myfont_green text-center" value="Wallet">
        </div>
        <div class="col-sm-4 myfield_midium p-3">
                <input type="button" onclick="location.href=''" class="mybtn_exlg btn-secondary font-weight-bold myfont_green text-center" value="History">
        </div>
        <div class="col-sm-2 myfield_midium"></div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/home/home.js') }}"></script>
@endsection
