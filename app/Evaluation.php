<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'user_id', 'stock_code', 'buy_id', 'sale_id', 'evaluate_date', 'comment',
        'point', 'next_check', 'delete_flag', 'profit',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
       // 'created_at' => 'datetime',
    ];

    public function evaluation()
    {
        return $this->belongTo('App\Stock');
    }
}