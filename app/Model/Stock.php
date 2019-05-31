<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $primaryKey = "stock_code";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stock_code', 'name', 'sales_num', 'created_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
    ];
    
    public function evaluations()
    {
        return $this->hasMany('\App\Model\Evaluation', 'stock_code');
    }
}