<?php

namespace App\Http\Requests\WEB\User\Admin;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(request('admin'))
            ],
            'name' => 'required',
            'phone' => 'required|numeric',
            'file' => 'image|mimes:png,jpg,jpeg'
        ];
    }
}
