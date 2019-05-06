<?php

namespace App\Http\Controllers;

use \App\Stock as Stock;
use \App\Evaluation as Evaluation;

use Illuminate\Http\Request as Request;
use Exception;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $evaluations = getEvaluationListModels()->get();
        return view('list',[
            "evaluations" => $evaluations
        ]);
    }

    /**
     * Add the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listRegist(Request $request)
    {
        logger($request);

        //受け取ったJSONを展開する。
        $validator = $request->validate([
            'evaluate_date' => 'required|date',
            'stock_code' => 'required|max:4',
            'name' => 'required|max:20',
            'comment' => 'max:255',
            'point' => 'required|integer|between:0,100',
            'next_check' => 'required|date',
        ]);

        //レコードの作成
        $stock = Stock::updateOrCreate([
            'stock_code' => $request->input('stock_code'),
        ], [
            'stock_code' => $request->input('stock_code'),
            'name' => $request->input('name'),
        ]);

        $evaluation = Evaluation::create([
            //user_idは現状1ユーザーのみ。今後機能拡張。
            'user_id'=>"1",
            'evaluate_date' => $request->input('evaluate_date'),
            'stock_code' => $request->input('stock_code'),
            'comment' => $request->input('comment'),
            'point' => $request->input('point'),
            'next_check' => $request->input('next_check')
        ]);
        //Evaluations dataを取得
        $evaluations = getEvaluationListModels()->get();
        
        return response()->json(
            [
                'data' => $evaluations
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * Add the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listUpdate(Request $request)
    {
        info($request);

        //受け取ったJSONを展開する。
        $validator = $request->validate([
            'id' => 'required',
            'evaluate_date' => 'required|date',
            'stock_code' => 'required|max:4',
            'name' => 'required|max:20',
            'comment' => 'max:255',
            'point' => 'required|integer|between:0,100',
            'next_check' => 'required|date',
        ]);

        //レコード更新。
        $evaluation_id = $request->input('id');
        try {
            $evaluation = Evaluation::where('id', $evaluation_id)->update([
                //user_idは現状1ユーザーのみ。今後機能拡張。
                'evaluate_date' => $request->input('evaluate_date'),
                'comment' => $request->input('comment'),
                'point' => $request->input('point'),
                'next_check' => $request->input('next_check')
            ]);
        } catch (Exception $e){
            echo '例外キャッチ：', $e->getMessage(),"\n";
        }

        //Evaluations dataを取得
        $evaluations = getEvaluationListModels()->where('id','=',$evaluation_id)->get();
        
        return response()->json(
            [
                'data' => $evaluations
            ],
            200,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    /*
     * Delete evaluation list
     * 
     */
    public function listDelete($id){
        try {
            Evaluation::find($id)->delete();
            //info(Evaluation::withTrashed()->get());
            return redirect('/list');
        } catch ( Exception $e ) {
            echo '例外キャッチ：', $e->getMessage(),"\n";
        } 
    }
}

/**
 * Functions for evaluation list
 */
function getEvaluationListModels(){
        $evaluations = \DB::table('evaluations')
                            ->join('stocks','evaluations.stock_code','=','stocks.stock_code');
        return $evaluations;
}

?>