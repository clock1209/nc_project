<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client','user','quote_date','phone_number','email','address','description','retainer','budget','delivery_date', 'priority', 'status',
    ];

    protected $dates = ['deleted_at'];
}
