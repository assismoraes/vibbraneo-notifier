<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveEmailChannelRequest extends FormRequest
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
            'smtp_server_name' => 'required',
            'port' => 'required|numeric',
            'login' => 'required',
            'password' => 'required|confirmed'
        ];
    }

    public function messages() {
        return [
            'smtp_server_name.required' => 'The SMTP server name is required',
            'port.required' => 'The port is required',
            'login.required' => 'The login is required',
            'password.required' => 'The password is required',
            'password.confirmed' => 'The password and password confirmation do not match'
        ];
    }
}
