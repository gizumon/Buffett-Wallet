<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'date',
        'price',
        'reason',
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

    public function evaluations()
    {
        return $this->hasOne('\App\Model\Evaluation');
    }
    /* 
     * Soft Delete
     *
     * 
    */ 
    protected $dates = ['deleted_at'];
}
