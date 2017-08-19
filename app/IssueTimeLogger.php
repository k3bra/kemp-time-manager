<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
            $hours = $hours + $data->hours;

            $this->where('user_id', '=', $userId)
                ->where('issue_id', '=', $issueId)
                ->where('date', '=', $date)->update(['hours' => $hours]);
        }

        return $hours;
    }

    public function getTotalHoursById(int $id)
    {
        $data = $this->select(DB::raw('SUM(hours) as total'))->where('issue_id', '=', $id)->first();

        return isset($data->total) ? $data->total : 0;
    }

}