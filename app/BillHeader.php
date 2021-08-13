<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillHeader extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_no',
        'date',
        'customer_id',
        'total_amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'customer_id' => 'integer',
        'total_amount' => 'decimal:2',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'date',
    ];


    public function customer()
    {
        return $this->belongsTo(\App\Customer::class);
    }
    public function billHeaderItems()
    {
        return $this->hasMany(\App\billHeaderItems::class,'bill_id');
    }
}
