<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreationUpdatePost extends FormRequest
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
        $id = $this->segment(2);

        $rules = [
            'title' => [
                'required',
                'min:5',
                'max:200',
                Rule::unique('tickets')->ignore($id),
            ],
            'content' => ['required', 'min:10'],
            'category' => ['required'],
            'urgency' => ['required'],
            'image' => ['nullable'],
            'status' => ['nullable']
        ];

        return $rules;
    }
}
