<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaTotal extends Model
{
    protected $fillable = [
        'id_client','id_user','folio', 'client', 'user','total',
    ];
}
