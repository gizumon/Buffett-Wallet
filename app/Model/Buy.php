<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'evaluation_id', 'stock_code', 'buy_date', 'expectancy'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'created_at' => 'datetime',
    ];

    public function evaluation()
    {
        return $this->belongTo('\App\Stock');
    }
    /*
     * Soft Delete
     *
     * 
    */ 
    protected $dates = ['deleted_at'];
}