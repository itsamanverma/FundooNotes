<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoteImages extends Model
{
     protected $fillable = [
        'pic' , 'noteid'
     ];
}
