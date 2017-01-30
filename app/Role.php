<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class Role extends EntrustRole
{
	use Notifiable, EntrustUserTrait;

    protected $fillable = [
        'name', 'display_name', 'description',
    ];
}
