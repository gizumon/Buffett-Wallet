@extends('layouts.app')

@section('content')
<div class="container-fuluid mygray_light">
        <div class="myfield_large myfont_green row item-center-block">
            <div class="col-sm-3"></div>
            <div class="text-center col-sm-6 font-weight-bold myfont-family_words">It takes 20 years to build a reputation and five minuted to ruin it. If you think about that, you’ll do things differently.</div>
            <div class="col-sm-3"></div>
        </div>
</div>
<div class="container-fuluid">
    <div class="row mygreen_light">
        <div class="col-sm-2 myfield_midium"></div>
        <div class="col-sm-4 mygreen_light myfield_midium p-3">
                <input type="button" onclick="location.href='/list'" class="mybtn_exlg btn-secondary font-weight-bold myfont_green text-center" value="List">
        </div>
        <div class="col-sm-4 myfield_midium p-3">
                <input type="button" onclick="location.href=''" class="mybtn_exlg btn-secondary font-weight-bold myfont_green text-center" value="Compare" style="font-size:6vw">
        </div>
        <div class="col-sm-2 myfield_midium"></div>
    </div>
    <div class="row mygreen_light">
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
@endsection
