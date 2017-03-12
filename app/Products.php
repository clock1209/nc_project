<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Products extends Model
{
	use SoftDeletes;

    protected $fillable = [
        'code','name', 'details', 'category','sale_price', 'production_cost', 'description', 'quantity',
    ];

    protected $dates = ['deleted_at'];
}
