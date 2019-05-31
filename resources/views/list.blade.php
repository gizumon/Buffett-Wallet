@extends('layouts.app')

@section('content')
<div>
<div class="inline-block">
    <span class="myfont_green mytitle">Reserch Stock</span><br>
</div>
<div class="content-block">
    <div class="container col-md-8 mygray_normal myrounded justify-content-center">
      <form id="serch">
        <div class="row">
          <div class="col-md-1"></div>
          <label class="text-left col-md-2 font-weight-bold">STOCK CODE</label>
          <input id="serch_code" class="col-md-5 form-control myform_size" type="tel" maxlength=4 placeholder="ex) 7779">
          <div class="col-md-4"></div>
        </div>
        <div id="displaySearch" style="display:none;">
          <div class="row">
            <div class="col-md-1"></div>
            <label id="setStockCode" class="text-left col-md-11 font-weight-bold">WEB SITE</label><br>
          </div>
          <div class="col-md-9 mx-auto">
              <table class="text-left table table-hover table-striped" style="margin-bottom: -1rem;">
                <tbody class="myfont">
                  <tr><td class="myline_height"><a class="setSearchValue myfont font-wight-bold" href="https://www.buffett-code.com/company/STOCK_CODE" target="_blank">[決算・財務分析] : バフェット・コード</a></td></tr>
                  <tr><td class="myline_height"><a class="setSearchValue myfont font-wight-bold" href="https://kabuyoho.ifis.co.jp/index.php?action=tp1&sa=report_top&bcode=STOCK_CODE" target="_blank">[アナリスト評価] : 株予報</a></td></tr>
                  <tr><td class="myline_height"><a class="setSearchValue myfont font-wight-bold" href="https://twitter.com/search?src=typd&q=STOCK_CODE%E3%80%80NAME" target="blank">[世論・評判分析] : Twitter</a></td></tr>
                </tbody>
              </table>
          </div>
        </div>
      </form>
    </div>
</div>
<div class="inline-block">
    <div class="col-md-.5"></div>
    <span class="myfont_green mytitle">Evaluation List</span><br>
</div>
<div class="container col-md-12">
  <table class="text-left table table-hover table-striped mygray_normal" style="margin-bottom: -1rem;">
    <thead>
      <tr>
        <th>Evaluation at</th>
        <th>Stock code</th>
        <th>Name</th>
        <th>Comment</th>
        <th>Point</th>
        <th>Next check</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody class="myfont">
    @if(count($evaluations) > 0)
      @foreach($evaluations as $evaluation)
        <tr id="listRow_{{$evaluation->id}}" data-id="{{$evaluation->id}}">
          <td class="myline_height">{{$evaluation->evaluate_date}}</td>
          <td id="stockCodeRow_{{$evaluation->id}}" class="myline_height">{{$evaluation->stock_code}}</td>
          <td id="nameRow_{{$evaluation->id}}" class="myline_height">{{$evaluation->name}}</td>
          <td id="commentRow_{{$evaluation->id}}" class="myline_height">{{$evaluation->comment}}</td>
          <td id="pointRow_{{$evaluation->id}}" class="myline_height">{{$evaluation->point}}</td>
          <td class="myline_height">{{$evaluation->next_check}}</td>
          <td class="myline_height">
            <button id="update-modal" type="button" class="btnInfo mybtn_xs btn-success" data-toggle="modal" data-target="#modal-update" data-id="{{$evaluation->id}}">
              Edit
            </button>
          </td>
          <td class="myline_height">
            <form id="delete" class="no_padding" action="/list/{{$evaluation->id}}" method="POST">
				  	@csrf
            @method('DELETE')
              <input type="hidden" name="_method" value="DELETE">
				  	  <button type="submit" class="mybtn_xs btn-danger" onclick="return confirm('銘柄コード：'+{{$evaluation->stock_code}}+' を削除します。よろしいですか？')">
				  			<i class="fa fa-trash"></i>Delete
				  		</button>
            </form>
          </td>
        </tr>
      @endforeach
    @else
      <tr class="myrow-message">
        <td colspan="8">Newボタンからリストに追加して下さい</td>
      </tr>
    @endif
      <tr>
        <td class="myline_height" colspan="8">
            <button type="button" class="btn btn-success col-md-12 myline_height" data-toggle="modal" data-target="#modal-regist">
              + New +
            </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
<div class="modal fade" id="modal-regist" tabindex="-1"
      role="dialog" aria-labelledby="label-regist" aria-hidden="true" data-keyboard="true">
  <div class="modal-dialog" role="document">
    <form id="regist" method="POST">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title myfont_green" id="label-regist">&nbsp;&nbsp;New</h5>
        <button type="button" class="close mymargin_right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="mytable_enter text-left table table-hover table-striped">
          <tbody class="mytable_input">
          @if(count($evaluations) > 0)
            <input type="hidden" name="evaluation_id" value="{{$evaluation->id}}">
          @endif
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Evaluation at</td>
              <td class="mytcol-60 myline_height"><input name="evaluate_date" class="col-md-11 today" type="date"></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Stock code</td>
              <td class="mytcol-60 myline_height"><input name="stock_code" class="col-md-11" maxlength="4" with="number" type="tel" placeholder="ex) 7779"></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Name</td>
              <td class="mytcol-60 myline_height"><input name="name" class="col-md-11" type="text" placeholder="ex) CYBERDYNE"></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Comment</td>
              <td class="mytcol-60 myline_height"><textarea name="comment" class="col-md-11" type="text" placeholder="You can enter multiple comments in commas(,)."></textarea></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Point</td>
              <td class="mytcol-60 myline_height"><input name="point" class="col-md-11" max=100 type="number" value=100></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Next check at</td>
              <td class="mytcol-60 myline_height"><input name="next_check" class="col-md-11 today" type="date"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button id="list-regist" type="button" class="btn mybtn_lg mygreen_dark center-block">Regist</button>
      </div>
    </div>
    </form>
  </div>
</div>
<div class="modal fade" id="modal-update" tabindex="-1"
      role="dialog" aria-labelledby="label-update" aria-hidden="true" data-keyboard="true">
  <div class="modal-dialog" role="document">
    <form id="update" method="PATCH">
    @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title myfont_green" id="label-update">&nbsp;&nbsp;Edit</h5>
        <button type="button" class="close mymargin_right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="mytable_enter text-left table table-hover table-striped">
          <tbody class="mytable_input">
          @if(count($evaluations) > 0)
            <input type="hidden" id="targetId" name="evaluation_id" value="">
          @endif
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Evaluation at</td>
              <td class="mytcol-60 myline_height"><input name="evaluate_date" class="col-md-11 today" type="date"></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Stock code</td>
              @if(count($evaluations) > 0)
              <td class="mytcol-60 myline_height"><input disabled id="targetStockCode" name="stock_code" class="col-md-11" maxlength="4" with="number" type="tel" value=""></td>
              @endif
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Name</td>
              @if(count($evaluations) > 0)
              <td class="mytcol-60 myline_height"><input disabled id="targetName" name="name" class="col-md-11" type="text" value=""></td>
              @endif
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Comment</td>
              <td class="mytcol-60 myline_height"><textarea id="targetComment" name="comment" class="col-md-11" type="text" placeholder="You can enter multiple comments in commas(,)."></textarea></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Point</td>
              <td class="mytcol-60 myline_height"><input id="targetPoint" name="point" class="col-md-11" max=100 type="number" value=></td>
            </tr>
            <tr>
              <td class="mytcol-40 myfont_black font-weight-bold myline_height">Next check at</td>
              <td class="mytcol-60 myline_height"><input name="next_check" class="col-md-11 today" type="date"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button id="list-update" type="button" class="btn mybtn_lg mygreen_dark center-block">Update</button>
      </div>
    </div>
    </form>
  </div>
</div>
<script src="/js/evaluationList/evaluationList.js" defer></script>
@endsection