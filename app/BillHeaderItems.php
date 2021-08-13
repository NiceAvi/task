<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillHeaderItems extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bill_id',
        'item_id',
        'rate',
        'qty',
        'base_amount',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'bill_id' => 'integer',
        'item_id' => 'integer',
        'rate' => 'decimal:2',
        'base_amount' => 'decimal:2',
    ];


    public function bill()
    {
        return $this->belongsTo(\App\BillHeader::class);
    }

    public function item()
    {
        return $this->belongsTo(\App\Item::class);
    }
}
