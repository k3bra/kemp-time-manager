<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueComment extends Model
{
    protected $table = 'issues_comments';

    public $timestamps = true;

    public $guarded = [];

    public function owner() {

        return $this->belongsTo(User::class, 'user_id');
    }
}
