<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class webSupport extends Model
{
	use SoftDeletes;

  protected $fillable = [
      'date','user','client','domain', 'motive', 'description','status','attentiontime',
  ];

  protected $dates = ['deleted_at'];
}
