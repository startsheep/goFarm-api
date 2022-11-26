<?php

namespace App\Http\Requests\WEB\User\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users,email|email',
            'name' => 'required',
            'phone' => 'required|numeric',
            'file' => 'required|image|mimes:png,jpg,jpeg'
        ];
    }
}
