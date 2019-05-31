<?php

namespace App\Repositories\Sale;

use DB;
use App\Model\Evaluation;
use App\Model\Stock;
use App\Model\Sale;

class SaleRepository implements SaleRepositoryInterface
{
    protected $table;

    public function __construct()
    {
      $this->table = 'buys';
    }

    /**
     * 売却データを全件取得()
     * @return array 取得したデータ
     */
    public function getAll()
    {
        return $this->getEvalWithSaleModel()
                    ->whereNotNull('sale_id')
                    ->get();
    }

    /**
     * 評価リスト(売却履歴込み)から指定したテーブルを取得
     * @param int 取得対象のテーブルID
     * @return array 取得したデータ
     */
    public function getId($id)
    {
        return $this->getEvalWithSaleModel()
                    ->where('id', $id)
                    ->get();
    }

    /**
     * 購入テーブルへレコード追加
     * @param array 追加対象のデータ
     * @return array 追加したレコード
     */
    public function create($array)
    {
        $evaluation_id = $array['evaluation_id'];

        DB::beginTransaction();
        try {
            $result = Buy::create($array);
            addSaleIdToEval($evaluation_id, [ "buy_id" => $result['id'] ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            info($e);
        }
        return $result;
    }

    /**
     * 購入テーブルのレコードを更新
     */
    public function update($id, $array)
    {
        return Sale::where('id', $id)->update($array);;
    }

    /**
     * 指定したIDのテーブルを削除
     * @param int
     * @return boolean
     */
    public function delete($id)
    {
        Sale::where('id', $id)->delete();
        return true;
    }

    // ローカル関数
    /**
     * Evaluationsテーブルを更新
     * @return model
     */
    private function getEvalWithSaleModel()
    {
        return Evaluation::join('sale_id','evaluations.sale_id','=','sales.id');
    }

    /**
     * Evaluationsテーブルを更新
     * @param int array
     * @return array
     */
    private function addSaleIdToEval($id, $array)
    {
        return Evaluation::where('id', $id)->update($array);
    }
}