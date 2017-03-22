<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaTotal extends Model
{
    protected $fillable = [
        'date','id_client','id_user','folio', 'client', 'user','total',
    ];
}
