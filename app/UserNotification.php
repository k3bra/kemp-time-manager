<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'user_notifications';

    protected $guarded = [];

    protected $timestamps = true;


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
