<?php

namespace App\Repositories\Sale;

interface SaleRepositoryInterface
{
    /**
     * 全件取得
     * @return array レコード
     */
    public function getAll();

    /**
     * 指定したIDのテーブルを取得
     * @param int ID
     * @return array 指定のレコード
     */
    public function getId($id);

    /**
    * 購入テーブルへレコード追加
    * @param array 追加対象のレコード
    * @return array 追加したレコード
    */
    public function create($array); 

    /**
     * テーブルを更新
     * @param int ID
     * @param array 追加レコード
     * @return array 追加レコード 
     */
    public function update($id, $array);

    /**
     * 指定したIDのテーブルを削除
     * @param int ID
     * @return boolean 成功/失敗
     */
    public function delete($id);

}