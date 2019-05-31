<?php

namespace App\Repositories\Buy;

use DB;
use App\Model\Evaluation;
use App\Model\Stock;
use App\Model\Buy;

class BuyRepository implements BuyRepositoryInterface
{
    protected $table;

    public function __construct()
    {
      $this->table = 'buys';
    }

    /**
     * 購入データを全件取得(売却済みを含む)
     * @return array 取得したデータ
     */
    public function getAll()
    {
        return $this->getEvalWithBuyModel()
                    ->whereNotNull('buy_id')
                    ->get();
    }

    /**
     * 売却済みを除く購入データを取得
     * @return array 取得したデータ
     */
    public function getNotSoldAll()
    {
        return $this->getEvalWithBuyModel()
                    ->whereNotNull('buy_id')
                    ->whereNull('sale_id')
                    ->get();
    }

    /**
     * 売却済みレコードを全件取得(sale_idに値があるレコード)
     * @return array 取得したデータ
     */
    public function getSoldAll()
    {
        return $this->getEvalWithBuyModel()
                    ->whereNotNull('sale_id')
                    ->get();
    }

    /**
     * 評価リスト(購入履歴込み)から指定したテーブルを取得
     * @param int 取得対象のテーブルID
     * @return array 取得したデータ
     */
    public function getId($id)
    {
        return $this->getEvalWithBuyModel()
                    ->where('id',$id)
                    ->get();
    }

    /**
     * 購入テーブルへレコード追加
     * @param int 対象の評価テーブルID
     * @param array 追加対象のデータ
     * @return array 追加したレコード
     */
    public function create($array)
    {
        info($array);
        $evaluation_id = $array['evaluation_id'];

        DB::beginTransaction();
        try {
            $result = Buy::create($array);
            $this->addBuyIdToEval($evaluation_id, [ "buy_id" => $result['id'] ]);

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
        return Buy::where('id', $id)->update($array);;
    }

    /**
     * 指定したIDのテーブルを削除
     * @param int
     * @return boolean
     */
    public function delete($id)
    {
        Buy::where('id', $id)->delete();
        return true;
    }

    // ローカル関数
    /**
     * Evaluationsテーブルを更新
     * @return model
     */
    private function getEvalWithBuyModel()
    {
        return Evaluation::join('buy_id','evaluations.buy_id','=','buys.id');
    }

    /**
     * Evaluationsテーブルを更新
     * @param int ID
     * @param array data
     * @return array
     */
    private function addBuyIdToEval($id, $array)
    {
        return Evaluation::where('id', $id)->update($array);
    }
}