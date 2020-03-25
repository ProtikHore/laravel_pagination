<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'id' => 'nullable|numeric',
            'name'=> 'required|max:255|string',
            //'email'=> 'required|email|max:255|string|unique:users.email'. $this->id,
            'mobile_number'=> 'nullable|digits:11',
            'status' => [Rule::in('Active', 'Inactive')],
            'narrative' => 'nullable|max:255'
        ];
    }
}
