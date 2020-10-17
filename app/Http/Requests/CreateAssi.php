<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAssi extends FormRequest
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
            'name' => ['bail','required', 'string', 'max:50'],
            'content' => ['bail','required', 'string'],
            'type' => ['bail','required', 'digits_between:1,2'],
            // 'files' => 'bail|mimes:docx,pdf,doc|max:2048'
        ];
    }
}
