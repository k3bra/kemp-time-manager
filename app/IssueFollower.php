<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueFollower extends Model
{
    protected $table = 'issues_followers';

    public $timestamps = true;

    public $guarded = [];

    public function followedBy()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function issueBy()
    {
        return $this->belongsTo(Issue::class, 'issue_id');
    }

}