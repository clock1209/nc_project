<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motive extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'description',
    ];

    protected $dates = ['deleted_at'];
}
