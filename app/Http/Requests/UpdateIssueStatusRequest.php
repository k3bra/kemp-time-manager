<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\Gate;
use Illuminate\Foundation\Http\FormRequest;
use App\Issue;

class UpdateIssueStatusRequest extends FormRequest
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

        return ['issueId' => 'required', 'statusId' => 'required'];
    }


    public function update()
    {
        $statusId= $this->input('statusId');
        $issueId = $this->input('issueId');

        $issue = Issue::find($issueId);
        $issue->status = $statusId;

        $issue->save();

    }
}
