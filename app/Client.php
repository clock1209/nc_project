<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use Notifiable, SoftDeletes;

    protected $fillable = [
        'name','lastNameFather','lastNameMother', 'email', 'address','homePhone','cellPhone',
    ];

    protected $dates = ['deleted_at'];
}
