<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'item',
        'quantity',
        'driver_id',
        'condition',
        'kind',
    ];

    public function NameDriver()
    {
        return $this->belongsTo(Driver::class, 'driver_id', 'id');
    }
}
