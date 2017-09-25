<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $table = 'users_notifications';

    protected $guarded = [];

    public $timestamps = true;


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function getNotSeenUserNotifications(int $userId)
    {
        return $this->where('user_id', '=', $userId)
            ->where('seen', '=', 0)->get();
    }
}
