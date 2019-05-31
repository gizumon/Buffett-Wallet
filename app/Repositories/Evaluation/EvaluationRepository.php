<?php

namespace App\Repositories\Evaluation;

use DB;
use App\Model\Evaluation;
use App\Model\Stock;

class EvaluationRepository implements EvaluationRepositoryInterface
{
    protected $table;

    public function __construct()
    {
      $this->table = 'evaluations';
    }

    /**
     * EvaluationsテーブルとStockテーブルをjoinして全件取得(未購入のもの)
     * @return array 取得したデータ
     */
    public function getAll()
    {
        return $this->getEvalWithStockModel()
                    ->whereNull('sale_id')
                    ->get();
    }

    /**
     * 購入も売却もされていない株
     * @return array 取得したデータ
     */
    public function getNotBoughtAll()
    {
        return $this->getEvalWithStockModel()
                    ->whereNull('buy_id')
                    ->whereNull('sale_id')
                    ->orderBy('point','desc')
                    ->get();
    }

    /**
     * 購入株を全件取得(buy_idに値がある株)
     * @return array 取得したデータ
     */
    public function getBoughtAll()
    {
        return $this->getEvalWithStockModel()
                    ->whereNotNull('buy_id')
                    ->whereNull('sale_id')
                    ->orderBy('point','desc')
                    ->get();
    }

    /**
     * 指定したテーブルを取得
     * @param int 取得対象のテーブルID
     * @return array 取得したデータ
     */
    public function getId($id)
    {
        return $this->getEvalWithStockModel()
                    ->where('id','=',$id)
                    ->get();
    }

    /**
     * Evaluationsへテーブル追加
     * @param array 追加対象のデータ
     * @return int 追加したレコードID
     */
    public function create($array)
    {
        $result = Evaluation::create($array);
        return $result;
    }

    /**
     * Stocksテーブル追加/更新
     * @param array 存在チェック用のデータ
     * @param array 追加/更新対象のデータ
     * @return int 追加したテーブルID
     */
    public function upsertStock($checkArray, $updateArray)
    {
        $result = STOCK::updateOrCreate($checkArray, $updateArray);
        return $result;
    }
    
    /**
     * Evaluationsテーブルを更新
     * @param int array
     * @return array
     */
    public function update($id, $array)
    {
        return Evaluation::where('id', $id)->update($array);
    }

    /**
     * 指定したIDのテーブルを削除
     * @param int
     * @return boolean
     */
    public function delete($id)
    {
        Evaluation::where('id', $id)->delete();
        return true;
    }

    private function getEvalWithStockModel()
    {
        return Evaluation::join('stocks','evaluations.stock_code','=','stocks.stock_code');
    }
}