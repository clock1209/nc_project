<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Role extends EntrustRole
{
	use Notifiable;

    protected $fillable = [
        'name', 'display_name', 'description',
    ];
}
