<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	protected $fillable = [
        'folio','product', 'quantity', 'unitary_price','subtotal',
    ];
}
