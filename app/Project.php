<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table = 'projects';
    protected $guarded = [];
    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }
}