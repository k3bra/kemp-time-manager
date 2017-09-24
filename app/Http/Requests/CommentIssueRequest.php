<?php

namespace App\Http\Requests;

use App\Services\IssueUserNotification;
use Illuminate\Foundation\Http\FormRequest;
use App\IssueComment;

class CommentIssueRequest extends FormRequest
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
            'body' => 'required',
            'id' => 'required'
        ];
    }

    public function comment()
    {

        $issueComment = new IssueComment();

        $issueComment->create([
            'body' => $this->input('body'),
            'issue_id' => $this->input('id'),
            'user_id' => auth()->user()->id,
        ]);


        (new IssueUserNotification(IssueUserNotification::COMMENT_TYPE, $this->input('id')))->notify();

    }


}
