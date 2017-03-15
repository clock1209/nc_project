<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Quote extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'client','user','quote_date','phone_number', 'email', 'address','description','budget','expiration_date'
    ];

    protected $dates = ['deleted_at'];
}
