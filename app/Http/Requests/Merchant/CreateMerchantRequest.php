<?php

namespace App\Http\Requests\Merchant;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class CreateMerchantRequest extends FormRequest
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
        $validate = [
            'merchant_name' => 'required',
            'description' => 'required',
            'location_point' => 'required',
            'address' => 'required',
            'user_id' => 'unique:merchants,user_id'
        ];

        if (request('image')) {
            $validate['image'] = 'required|image|mimes:png,jpg,jpeg';
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
