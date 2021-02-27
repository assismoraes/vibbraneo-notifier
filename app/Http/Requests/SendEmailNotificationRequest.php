<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailNotificationRequest extends FormRequest
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
            'sender_name' => 'required',
            'email' => 'required|email',
            'content' => 'required',
            'application_id' => 'required|exists:applications,id',
        ];
    }

    public function messages() {
        return [
            'sender_name.required' => 'The sender name is required',
            'email.required' => 'The email name is required',
            'email.email' => 'Type a valid email',
            'content.required' => 'Type the email content',
            'application_id.required' => 'Choose an application',
            'application_id.exists' => 'Choose a valid application',
        ];
    }
}
