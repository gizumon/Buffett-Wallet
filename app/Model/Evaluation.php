<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'stock_code',
        'buy_id',
        'sale_id',
        'evaluate_date',
        'comment',
        'point',
        'next_check',
        'delete_flag',
        'profit',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'created_at' => 'datetime',
    ];
    /**
     * stocksテーブルとのリレーション(多vs1)
     */
    public function stocks()
    {
        return $this->belongTo('\App\Model\Stock');
    }

    /**
     * 
     */
    public function buys()
    {
        return $this->belongTo('\App\Model\Buy');
    }
    
    public function sales()
    {
        return $this->belongTo('\App\Model\Sale');
    }
    
    /*
     * Soft Delete
     *
     * 
    */ 
    protected $dates = ['deleted_at'];
}