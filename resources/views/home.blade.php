@extends('layouts.app')

@section('content')
<div class="container-fuluid">
    <div>
        <div class="row d-flex mygray_light myfield_large align-items-center myfont_green center-block">
            <div class="row"> 
                <p class="col-sm-3"></p>
                <p class="col-sm-6 text-center font-weight-bold myfont-family_words">It takes 20 years to build a reputation and five minuted to ruin it. If you think about that, you’ll do things differently.</p>
                <p class="col-sm-3"></p>
            </div>
        </div>
    </div>
</div>
<div class="container-fuluid">
    <div class="row">
        <div class="col-sm-2 mygreen_light myfield_midium"></div>
        <div class="col-sm-4 mygreen_light myfield_midium p-3">
                <button type="button" onclick="location.href=''" class="mybtn_exlg btn-secondary font-weight-bold myfont_green text-center">List</button>
        </div>
        <div class="col-sm-4 mygreen_light myfield_midium p-3">
                <button type="button" onclick="location.href=''" class="mybtn_exlg btn-secondary font-weight-bold myfont_green text-center" style="font-size: 4.3rem">Compare</button>
        </div>
        <div class="col-sm-2 mygreen_light myfield_midium"></div>
    </div>
    <div class="row">
        <div class="col-sm-2 mygreen_light myfield_midium"></div>
        <div class="col-sm-4 mygreen_light myfield_midium p-3">
                <button type="button" onclick="location.href=''" class="mybtn_exlg btn-secondary font-weight-bold myfont_green text-center">Wallet</button>
        </div>
        <div class="col-sm-4 mygreen_light myfield_midium p-3">
                <button type="button" onclick="location.href=''" class="mybtn_exlg btn-secondary font-weight-bold myfont_green text-center">History</button>
        </div>
        <div class="col-sm-2 mygreen_light myfield_midium"></div>
    </div>
</div>
@endsection
