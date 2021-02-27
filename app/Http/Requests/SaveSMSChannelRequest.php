<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveSMSChannelRequest extends FormRequest
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
            'sms_provider' => 'required',
            'login' => 'required',
            'password' => 'required|confirmed'
        ];
    }

    public function messages() {
        return [
            'sms_provider.required' => 'The SMS provider is required',
            'login.required' => 'The login is required',
            'password.required' => 'The password is required',
            'password.confirmed' => 'The password and password confirmation do not match'
        ];
    }
}
