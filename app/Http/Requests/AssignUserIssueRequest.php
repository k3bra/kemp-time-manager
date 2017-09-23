<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Issue;
class AssignUserIssueRequest extends FormRequest
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
        return ['issueId' => 'required', 'userId' => 'required'];
    }

    public function assignUser() {
        $userId = $this->input('userId');
        $issueId = $this->input('issueId');

        $issue = Issue::find($issueId);

        $issue->assigned_to = $userId;

        $issue->save();
    }
}
