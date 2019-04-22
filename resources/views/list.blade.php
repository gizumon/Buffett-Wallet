@extends('layouts.app')

@section('content')
<div>
<div class="row">
    <span class="myfont_green mytitle">Reserch Stock</span><br>
</div>
<div>
    <div class="container col-sm-8 mygray_normal myrounded justify-content-center">
      <form>
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
<div class="row">
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
						<i class=" "></i>Edit
          </button>
        </td>
        <td class="myline_height">
          <form class="no_padding" action="/list/{{$evaluation->id}}" method="DELETE">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					  <button type="submit" class="mybtn_xs btn-danger">
							<i class="fa fa-trash"></i>Delete
						</button>
          </form>
        </td>
      </tr>
    @endforeach
      <tr>
        <td class="myline_height" colspan="8">
          <button class="btn btn-success col-sm-12 mybtn_wd">
            <i class="plus">+</i>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
