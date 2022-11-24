<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateMerchantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $validate = [
            'merchant_name' => 'required',
            'description' => 'required',
            'location_point' => 'required',
            'address' => 'required',
            'user_id' => [
                Rule::unique('merchants')->ignore(request('id'))
            ]
        ];

        if (request('image')) {
            $validate['image'] = 'image|mimes:png,jpg,jpeg';
        }

        return $validate;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'meta' => [
                'message' => $validator->errors(),
                'status_code' => 400
            ]
        ], 400);

        throw new ValidationException($validator, $response);
    }
}
