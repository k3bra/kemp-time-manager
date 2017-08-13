<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueStatus extends Model
{

    protected $table = 'issues_status';
    public $timestamps = true;
                            
    public $guarded = [];
}
