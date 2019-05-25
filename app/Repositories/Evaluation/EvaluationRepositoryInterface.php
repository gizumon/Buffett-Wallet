<?php

namespace App\Repositories\Evaluation;

interface EvaluationRepositoryInterface
{
    /**
     * 全件取得
     * @return array input
     */
    public function getAll();

    /**
     * 指定したIDのテーブルを取得
     * @param int $id
     * @return array $table
     */
    public function getId($id);

    /**
     * テーブルを追加
     * @param array $
     * @return int
     */
    public function create($array);

    /**
     * テーブルを更新
     * @param int array
     * @return array
     */
    public function update($id, $array);

    /**
     * 指定したIDのテーブルを削除
     * @param int
     * @return boolean
     */
    public function delete($id);

}