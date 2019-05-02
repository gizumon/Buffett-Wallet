@extends('layouts.app')

@section('content')
<div>
<div class="inline-block">
    <span class="myfont_green mytitle">Reserch Stock</span><br>
</div>
<div>
    <div class="container col-sm-8 mygray_normal myrounded justify-content-center">
      <form id="serch">
        <div class="form-group row font-weight-bold">
          <div class="col-sm-1"></div>
          <label class="text-left col-sm-3 font-weight-bold">銘柄コード</label>
          <input class="col-sm-3 form-control myform_size" type="text" pattern="\d{4}" maxlength=4 value="0000">
          <div class="col-sm-2"></div>
          <input class="btn col-1 font-weight-bold mybtn_sm btn-success" type="button" value="Set">
        </div>
        <div class="form-group row">
          <div class="col-sm-1"></div>
          <label class="text-left col-sm-3 font-weight-bold">名前</label>
          <input class="col-sm-6 form-control myform_size" type="text" pattern="\d{4}" maxlength=20 placeholder="Please input stock name...">
        </div>
        <div class="form-group row">
          <div class="col-sm-1"></div>
          <label class="text-left col-sm-4 font-weight-bold">検索サイト</label><br>
          <div class="col-sm-9 mx-auto">
              <table class="text-left table table-hover table-striped" style="margin-bottom: -1rem;">
                <tbody class="myfont">
                  <tr><td class="myline_height"><a class="myfont font-wight-bold" href="https://www.buffett-code.com/company/stock_code">[決算・財務分析] : バフェット・コード</a></td></tr>
                  <tr><td class="myline_height"><a class="myfont font-wight-bold" href="https://kabuyoho.ifis.co.jp/index.php?action=tp1&sa=report_top&bcode=stock_code">[アナリスト評価] : 株予報</a></td></tr>
                  <tr><td class="myline_height"><a class="myfont font-wight-bold" href="https://twitter.com/search?src=typd&q=stock_code%E3%80%80$name">[世論・評判分析] : Twitter</a></td></tr>
                </tbody>
              </table>
          </div>
        </div>
      </form>
    </div>
</div>
<div class="inline-block">
    <div class="col-sm-.5"></div>
    <span class="myfont_green mytitle">Evaluation List</span><br>
</div>
<div class="container col-sm-12">
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
    @foreach($evaluations as $evaluation)
      <tr>
        <td class="myline_height">{{$evaluation->evaluate_date}}</td>
        <td class="myline_height">{{$evaluation->stock_code}}</td>
        <td class="myline_height">{{$evaluation->name}}</td>
        <td class="myline_height">{{$evaluation->comment}}</td>
        <td class="myline_height">{{$evaluation->point}}</td>
        <td class="myline_height">{{$evaluation->next_check}}</td>
        <td id="list_edit" class="myline_height">
					<button type="submit" class="mybtn_xs btn-success">
						<i class=""></i>Edit
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
      <tr>
        <td class="myline_height" colspan="8">
            <button type="button" class="btn btn-success col-sm-12 myline_height" data-toggle="modal" data-target="#modal-regist">
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
        <h5 class="modal-title myfont_green font-weight-bold" id="label-new">New</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="mytable_enter text-left table table-hover table-striped">
          <tbody>
            <tr>
              <td class="mytcol-30 myfont_black font-weight-bold myline_height">Evaluation at</td>
              <td class="mytcol-70 myline_height"><input name="evaluate_date" class="col-sm-11 form-control today font-weight-bold" type="date"></td>
            </tr>
            <tr>
              <td class="col-sm-4 myfont_black font-weight-bold myline_height">Stock code</td>
              <td class="col-sm-8 myline_height"><input name="stock_code" class="col-sm-11 form-control font-weight-bold" maxlength="4" with="number" type="tel" placeholder="ex) 7779"></td>
            </tr>
            <tr>
              <td class="col-sm-4 myfont_black font-weight-bold myline_height">Name</td>
              <td class="col-sm-8 myline_height"><input name="name" class="col-sm-11 form-control font-weight-bold" type="text" placeholder="ex) CYBERDYNE"></td>
            </tr>
            <tr>
              <td class="col-sm-4 myfont_black font-weight-bold myline_height">Comment</td>
              <td class="col-sm-8 myline_height"><textarea name="comment" class="col-sm-11 form-control font-weight-bold" type="text" placeholder="You can enter multiple comments in commas(,)."></textarea></td>
            </tr>
            <tr>
              <td class="col-sm-4 myfont_black font-weight-bold myline_height">Point</td>
              <td class="col-sm-8 myline_height"><input name="point" class="col-sm-11 form-control font-weight-bold" max=100 type="number" value=100></td>
            </tr>
            <tr>
              <td class="col-sm-4 myfont_black font-weight-bold myline_height">Next check at</td>
              <td class="col-sm-8 myline_height"><input name="next_check" class="col-sm-11 form-control today font-weight-bold" type="date"></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-lg btn-secondary center-block" data-dismiss="modal">Close</button>
        <button id="list-regist" type="button" class="btn-lg btn-primary center-block">OK</button>
      </div>
    </div>
    </form>
  </div>
</div>
<script src="/js/evaluationList/listRegist.js" defer></script>
@endsection