<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'retainer','budget','delivery_date', 'priority', 'status',
    ];

    protected $dates = ['deleted_at'];
}
