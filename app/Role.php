<?php

namespace App;

use Zizaco\Entrust\EntrustRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends EntrustRole
{
	use Notifiable, SoftDeletes;
	use EntrustUserTrait {
		EntrustUserTrait::restore insteadof SoftDeletes;
	}

    protected $fillable = [
        'name', 'display_name', 'description',
    ];

    protected $dates = ['deleted_at'];
}
