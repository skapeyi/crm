<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationCreateRequest extends FormRequest
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
            'name' => 'string|required',
            'address' => 'string|nullable',
            'phone' => 'string|required|min:10',
            'phone_alt' => 'string|nullable|min:10',
            'email' => 'email|required',
            'email_alt' => 'email|nullable',
            'level' => 'string|required',
            'payment_status' => 'string|required'
        ];
    }
}
