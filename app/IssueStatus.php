<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueStatus extends Model
{

    const OPEN = 1;
    const ON_HOLD = 2;
    const CLOSED = 3;
    const IN_PROGRESS = 4;
    const Q_A = 5;

    protected $table = 'issues_status';
    public $timestamps = true;

    public $guarded = [];
}
