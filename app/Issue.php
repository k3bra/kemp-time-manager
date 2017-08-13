<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{

    protected $table = 'issues';
    public $timestamps = true;

    public $guarded = [];

    public function createdBy() {

        return $this->belongsTo('App\User', 'created_by');
    }

    public function assignedTo() {
        return $this->belongsTo('App\User', 'assigned_to');
    }

    public function statusDesc() {
        return $this->belongsTo(IssueStatus::class, 'status');
    }
}