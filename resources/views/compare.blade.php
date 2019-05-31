@extends('layouts.app')

@section('content')
<div>
<div class="inline-block">
    <span class="myfont_green mytitle">Reserch Stock</span><br>
</div>
<div class="content-block">
    <div class="container col-md-8 mygray_normal myrounded justify-content-center">
      <div class="row">
        <div class="col-md-6 text-align-center"> 
          <button id="buy-modal" type="button" class="btnInfo btn-show-modal btn-success mx-auto d-block" data-toggle="modal" data-target="#modal-buy">
            Buy
          </button>
        </div>
        <div class="col-md-6"> 
          <button id="sell-modal" type="button" class="btnInfo btn-show-modal btn-success mx-auto d-block" data-toggle="modal" data-target="#modal-sell">
            Sell
          </button>
        </div>
      </div>
    </div>
</div>
<div class="container col-md-6 float-left">
  <table class="text-left table table-hover table-striped mygray_normal" style="margin-bottom: -1rem;">
  <caption class="myfont_green mytitle text-center">Bought list...</caption>
    <thead>
      <tr>
        <th>No.</th>
        <th>Stock code</th>
        <th>Name</th>
        <th>Point</th>
        <th>Next Check</th>
      </tr>
    </thead>
    <tbody class="myfont">
    @if( count($buys) > 0)
      @foreach($buys as $buy)
        <tr id="listRow_{{ $buy -> id }}" data-id="{{ $buy -> id }}">
          <td class="myline_height">{{ $loop -> iteration }}</td>
          <td class="myline_height">{{ $buy -> stock_code }}</td>
          <td class="myline_height">{{ $buy -> name }}</td>
          <td class="myline_height">{{ $buy -> point }}</td>
          <td class="myline_height">{{ $buy -> next_check }}</td>
        </tr>
      @endforeach
    @else
      <tr class="myrow-message">
        <td colspan="5">購入済みの株データがありません。</td>
      </tr>
    @endif
    </tbody>
  </table>
</div>
<div class="container col-md-6 float-left">
  <table class="text-left table table-hover table-striped mygray_normal" style="margin-bottom: -1rem;">
    <caption class="myfont_green mytitle text-center">Waiting list...</caption>
    <thead>
      <tr>
        <th>No.</th>
        <th>Stock code</th>
        <th>Name</th>
        <th>Point</th>
        <th>Next Check</th>
      </tr>
    </thead>
    <tbody class="myfont">
    @if( count($waitings) > 0)
      @foreach($waitings as $waiting)
        <tr id="listRow_{{ $waiting -> id }}" data-id="{{ $waiting -> id }}">
          <td class="myline_height">{{ $loop -> iteration }}</td>
          <td class="myline_height">{{ $waiting -> stock_code }}</td>
          <td class="myline_height">{{ $waiting -> name }}</td>
          <td class="myline_height">{{ $waiting -> point }}</td>
          <td class="myline_height">{{ $waiting -> next_check }}</td>
        </tr>
      @endforeach
    @else
      <tr class="myrow-message">
        <td colspan="5">購入待ちの株データがありません。</td>
      </tr>
    @endif
    </tbody>
  </table>
</div>
<div class="modal fade" id="modal-buy" tabindex="-1"
      role="dialog" aria-labelledby="label-regist" aria-hidden="true" data-keyboard="true">
  <div class="modal-dialog" role="document">
    <form id="buy" method="POST">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title myfont_green" id="label-buy">&nbsp;&nbsp;Buy</h5>
        <button type="button" class="close mymargin_right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="mytable_enter text-left table table-hover table-striped">
          <tbody class="mytable_input">
            <input type="hidden" name="evaluation_id" value="">
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Date</td>
              <td class="mytcol-60 myline_height"><input name="date" class="col-md-11 today" type="date"></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Stock code</td>
              <td class="mytcol-60 myline_height">
              <select class="col-md-11 form-control" name="stock_code">
              @if(count($waitings) > 0)
                <option class="option-title">評価株リスト</option>
                @foreach ($waitings as $waiting)
                  <option value="{{ $waiting -> stock_code }}" data-id="{{ $waiting -> id }}">{{ $waiting -> stock_code}}：{{ $waiting -> name }}</option>
                @endforeach
              @else
                <option>評価株がありません</option>
              @endif
              </select>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Price (Buy)</td>
              <td class="mytcol-60 myline_height"><input name="price" class="col-md-11" type="number" placeholder="ex) 1000"></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Expectancy</td>
              <td class="mytcol-60 myline_height"><input name="expectancy" class="col-md-11" type="number" placeholder="ex) 1000"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button id="buy-regist" type="button" class="btn mybtn_lg mygreen_dark center-block">Buy</button>
      </div>
    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modal-sell" tabindex="-1"
      role="dialog" aria-labelledby="label-sell" aria-hidden="true" data-keyboard="true">
  <div class="modal-dialog" role="document">
    <form id="sell" method="POST">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title myfont_green" id="label-sell">&nbsp;&nbsp;Sell</h5>
        <button type="button" class="close mymargin_right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="mytable_enter text-left table table-hover table-striped">
          <tbody class="mytable_input">
            <input type="hidden" name="evaluation_id">
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Date</td>
              <td class="mytcol-60 myline_height"><input name="date" class="col-md-11 today" type="date"></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Stock code</td>
              <td class="mytcol-60 myline_height">
              <select class="col-md-11 form-control" name="stock_code">
              @if(count($buys) > 0)
                <option class="option-title">購入株リスト</option>
                @foreach ($buys as $buy)
                  <option value="{{ $buy -> stock_code }}" data-id="{{ $buy -> id }}">{{ $buy -> stock_code}}：{{ $buy -> name }}</option>
                @endforeach
              @else
                <option>購入株がありません</option>
              @endif
              </select>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Price (Sell)</td>
              <td class="mytcol-60 myline_height"><input name="price" class="col-md-11" type="number" placeholder="ex) 1000"></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Description</td>
              <td class="mytcol-60 myline_height"><textarea name="description" class="col-md-11" type="text" placeholder="You can write down a reason why you sell the stock."></textarea></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button id="sale-regist" type="button" class="btn mybtn_lg mygreen_dark center-block">Sell</button>
      </div>
    </div>
    </form>
  </div>
</div>
<script src="/js/compareList/compareList.js" defer></script>
@endsection