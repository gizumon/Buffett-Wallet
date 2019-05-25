<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Repositories\Evaluation\EvaluationRepositoryInterface as Evaluation;

class ListController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Evaluation $interface)
    {
        $this->middleware('auth');
        $this->eval_rep = $interface;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $evaluations = $this->eval_rep -> getAll();
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
        info("listRegist() is called.\n Request::\n".$request);
        
        // メンバ変数定義
        $response;

        // 受け取ったJSONを展開する。
        $validator = $request->validate([
            'evaluate_date' => 'required|date',
            'stock_code' => 'required|max:4',
            'name' => 'required|max:20',
            'comment' => 'max:255',
            'point' => 'required|integer|between:0,100',
            'next_check' => 'required|date',
        ]);

        // Stockテーブル DB有無確認用
        $checkStockArray = [
            'stock_code' => $request->input('stock_code')
        ];

        // Stockテーブル DB更新用
        $updateStockArray = [
            'stock_code' => $request->input('stock_code'),
            'name' => $request->input('name')
        ];

        // Evaluationテーブル DB更新用
        $updateEvalArray = [
            //user_idは現状1ユーザーのみ。今後機能拡張。
            'user_id'=>"1",
            'evaluate_date' => $request->input('evaluate_date'),
            'stock_code' => $request->input('stock_code'),
            'comment' => $request->input('comment'),
            'point' => $request->input('point'),
            'next_check' => $request->input('next_check')
        ];

        try {
            // Stocksレコードの作成・更新()
            $this->eval_rep -> upsertStock($checkStockArray, $updateStockArray);
            // Evaluationsレコードの作成
            $response = $this->eval_rep -> create($updateEvalArray);

            // Evaluations dataを取得
            $evaluations = $this->eval_rep -> getAll();
        
        } catch (Exception $e) {
            info("ERROR::".$e);
        }

        info("listRegist() is successful.\n Response::\n".$response);
        return response()->json(
            [
                'data' => $response
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

        // メンバ変数
        $response;

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
        $id = $request->input('id');
        $array = [
            //user_idは現状1ユーザーのみ。今後機能拡張。
            'evaluate_date' => $request->input('evaluate_date'),
            'comment' => $request->input('comment'),
            'point' => $request->input('point'),
            'next_check' => $request->input('next_check')
        ];

        try {
            $response = $this->eval_rep -> update($id, $array);
        } catch (Exception $e){
            report($e->getMessage());
        }
       
        return response()->json(
            [
                'data' => $response
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
            $this->eval_rep->delete();
            return redirect('/list');
        } catch ( Exception $e ) {
            report($e->getMessage());
        } 
    }
}