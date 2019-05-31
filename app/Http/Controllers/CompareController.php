<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as Request;
use Exception;

use App\Repositories\Evaluation\EvaluationRepositoryInterface as Evaluation;
use App\Repositories\Buy\BuyRepositoryInterface as Buy;
use App\Repositories\Sale\SaleRepositoryInterface as Sale;

class CompareController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Evaluation $interfaceEval, Buy $interfaceBuy, Sale $interfaceSale)
    {
        $this->middleware('auth');
        $this->eval_rep = $interfaceEval;
        $this->buy_rep = $interfaceBuy;
        $this->sale_rep = $interfaceSale;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $waitings = $this->eval_rep -> getNotBoughtAll();
        $buys = $this->eval_rep -> getBoughtAll();
//        $sales = $this->sale_rep -> getAll();

        return view('compare',[
            "waitings" => $waitings,
            "buys" => $buys,
//            "sales" => $sales
        ]);
    }

    /**
     * Add the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function buyRegist(Request $request)
    {
        info("buyRgist() is called.\n Request::\n".$request);
        $status;

        //受け取ったJSONを展開する。
        $validator = $request->validate([
            'evaluation_id' => 'required|integer',
            'date' => 'required|date',
            'price' => 'required|integer',
            'expectancy' => 'required|integer'
        ]);

        $array = [
            'evaluation_id' => $request -> input('evaluation_id'),
            'date' => $request -> input('date'),
            'price' => $request -> input('price'),
            'target_price' => $request -> input('expectancy')
        ];
                
        try {
            $result = $this->buy_rep -> create($array);
            $status = 200;
        } catch(Exception $e) {
            info("ERROR::".$e);
            $status = 500;
        }

        return response()->json(
            [
                "data" => $result
            ],
            $status,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * Add the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saleRegist(Request $request)
    {
        info("saleRgist() is called.\n Request::\n".$request);
        $status;

        //受け取ったJSONを展開する。
        $validator = $request->validate([
            'evaluation_id' => 'required|integer',
            'date' => 'required|date',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        $array = [
            'evaluation_id' => $request -> input('evaluation_id'),
            'date' => $request -> input('date'),
            'price' => $request -> input('price'),
            'reason' => $request -> input('description')
        ];
                
        try {
            $result = $this->sale_rep -> create($array);
            $status = 200;
        } catch(Exception $e) {
            info("ERROR::".$e);
            $status = 500;
        }

        return response()->json(
            [
                "data" => $result
            ],
            $status,[],
            JSON_UNESCAPED_UNICODE
        );
    }
    
    /**
     * Add the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function buyUpdate(Request $request)
    {
        info("buyUpdate() is called.\n Request::\n".$request);
        $status;

        //受け取ったJSONを展開する。
        $validator = $request->validate([
            'buy_id' => 'required|integer',
            'date' => 'required|date',
            'price' => 'required|integer',
            'expectancy' => 'required|integer',
        ]);

        //レコード更新
        $buy_id = $request -> input('buy_id');
        $array = [
            'date' => $request -> input('date'),
            'price' => $request -> input('price'),
            'target_price' => $request -> input('expectancy')    
        ];

        try {
            $result = $this->buy_rep->update($buy_id, $array);
            $status = 200; 
        } catch (Exception $e){
            info("ERROR::".$e);
            $status = 500;
        }
        
        return response()->json(
            [
                'data' => $result
            ],
            $status,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    /**
     * Add the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saleUpdate(Request $request)
    {
        info("saleUpdate() is called.\n Request::\n".$request);
        $status;

        //受け取ったJSONを展開する。
        $validator = $request->validate([
            'sale_id' => 'required|integer',
            'date' => 'required|date',
            'price' => 'required|integer',
            'description' => 'required',
        ]);

        //レコード更新
        $sale_id = $request -> input('sale_id');
        $array = [
            'date' => $request -> input('date'),
            'price' => $request -> input('price'),
            'reason' => $request -> input('description')    
        ];

        try {
            $result = $this->sale_rep->update($sale_id, $array);
            $status = 200;
        } catch (Exception $e){
            info("ERROR::".$e);
            $status = 500;
        }
        
        return response()->json(
            [
                'data' => $result
            ],
            $status,[],
            JSON_UNESCAPED_UNICODE
        );
    }

    /*
     * Delete evaluation list
     * 
     */
    public function buyDelete($id){
        info("buyDelete() is called.\n Request::\n".$request);
        $status;

        try {
            $this->buy_rep->delete($id);
            $status = 200;
        } catch ( Exception $e ) {
            info("ERROR::".$e);
            $status = 500;
        }
        
        return response()->json(
            [
                'data' => true
            ],
            $status,[],
            JSON_UNESCAPED_UNICODE
        );
    }
}

?>