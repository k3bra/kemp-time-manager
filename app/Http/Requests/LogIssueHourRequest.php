<?php

namespace App\Http\Requests;

use App\IssueTimeLogger;
use Illuminate\Foundation\Http\FormRequest;

class LogIssueHourRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            [
                'id' => 'required|integer',
                'hours' => 'required|integer',
                'date' => 'date'
            ]
        ];
    }

    public function logHour(int $userId) : int
    {

        $currentNrHours = (new IssueTimeLogger())->logHour(
            $userId,
            $this->input('id'),
            $this->input('hours'),
            $this->input('date')
        );

        return $currentNrHours;
    }
}
