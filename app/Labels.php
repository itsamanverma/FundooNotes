<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Labels extends Model
{
     protected $fillable = [
        'label', 'userid', 
    ];
}
