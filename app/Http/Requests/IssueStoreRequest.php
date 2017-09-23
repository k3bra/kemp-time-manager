<?php

namespace App\Http\Requests;

use App\Issue;
use Illuminate\Foundation\Http\FormRequest;

class IssueStoreRequest extends FormRequest
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
            'name' => 'required|unique:issues',
            'estimated' => 'required|integer',
            'description' => 'required',
            'status' => 'required',
            'project' => 'required',
        ];
    }

    public function store() {

        Issue::create([
            'name' => $this->input('name'),
            'created_by' => auth()->user()->id,
            'description' => $this->input('description'),
            'estimated_time' => $this->input('estimated'),
            'project_id' => $this->input('project'),
            'status' => $this->input('status'),
            'assigned_to' => auth()->user()->id,
        ]);
    }
}
