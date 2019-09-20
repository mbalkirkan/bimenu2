<?php

namespace Bimenu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email',
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone' => 'required|numeric',
            'country' => 'required|numeric',
            'notification_token'=>'',
            'coins'=>'numeric',
            'authority'=>'required|numeric',
            'photo' => 'required|string',
            'password' => 'required|string',
            'c_password' => 'required|same:password',
        ];
    }
}
