<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class webSupport extends Model
{
  protected $fillable = [
      'date','user','client','domain', 'motive', 'description','status','attentiontime',
  ];
}
