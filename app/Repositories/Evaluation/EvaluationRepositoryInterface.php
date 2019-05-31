<?php

namespace App\Repositories\Evaluation;

interface EvaluationRepositoryInterface
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
     * 購入済み株のテーブルを取得
     * @return array レコード
     */
    public function getBoughtAll();

    /**
     * 購入も売却もされていない株
     * @return array 取得したデータ
     */
    public function getNotBoughtAll();

    /**
     * テーブルを追加
     * @param array 追加レコード
     * @return int ID
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