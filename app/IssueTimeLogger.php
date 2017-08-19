<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueTimeLogger extends Model
{

    protected $table = 'issues_time_logger';
    public $timestamps = false;
    public $guarded = [];

    public function logHour(int $userId, int $issueId, int $hours, string $date)
    {

        $data = $this->where('user_id', '=', $userId)
            ->where('issue_id', '=', $issueId)
            ->where('date', '=', $date)->first();

        if (!$data) {
            $this->create([
                'user_id' => $userId,
                'issue_id' => $issueId,
                'date' => $date,
                'hours' => $hours
            ]);
        } else {
            $addedHours = $hours + $data->hours;

            $this->where('user_id', '=', $userId)
                ->where('issue_id', '=', $issueId)
                ->where('date', '=', $date)->update(['hours' => $addedHours]);
        }

    }

    public function checkIfExistsByUniqueKey($user)
    {
        $this->where();

    }
}