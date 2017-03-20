<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
	use SoftDeletes;

	protected $fillable = [
        'folio','id_producto','product', 'quantity', 'unitary_price','subtotal',
    ];
}
