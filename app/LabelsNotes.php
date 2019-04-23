<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabelsNotes extends Model
{
 protected $fillable = [
        'labelid', 'userid','noteid' 
    ];

    protected $with = ['labelname'];

    public function labelname()
    {
        return $this->belongsTo('App\Labels', 'labelid');
    }}
