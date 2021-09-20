<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class NewOperationRequests extends FormRequest
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
            'name'                => 'required|max:255',
            'surname1'            => 'required|max:255',
            'surname2'            => 'required|max:255',
            'email'               => 'required|max:255|email|unique:clients',
            'phone'               => 'required|max:255|unique:clients',
            'provided_capital'    => 'required|integer|lte:total_capital',
            'total_capital'       => 'required|integer'
        ];
    }
    public function messages()
    {
        return [
            'name.required'                 => 'The :attribute field is required',
            'name.max'                      => 'The :attribute field is too long 255 characters maximum',
            'surname1.required'             => 'The :attribute field is required',
            'surname1.max'                  => 'The :attribute field is too long 255 characters maximum',
            'surname2.required'             => 'The :attribute field is required',
            'surname2.max'                  => 'The :attribute field is too long 255 characters maximum',
            'email.required'                => 'The :attribute field is required',
            'email.max'                     => 'The :attribute field is too long 255 characters maximum',
            'email.email'                   => 'Mail must be formatted correctly',
            'email.unique'                  => 'This :attribute alredy exists',
            'phone.required'                => 'The :attribute field is required',
            'phone.max'                     => 'The :attribute field is too long 255 characters maximum',
            'phone.email'                   => 'Mail must be formatted correctly',
            'phone.unique'                  => 'This :attribute alredy exists',
            'provided_capital.required'     => 'The :attribute field is required',
            'provided_capital.max'          => 'The :attribute field is too long 255 characters maximum',
            'provided_capital.integer'      => 'The :attribute field must be a number',
            'provided_capital.lte'          => 'The :attribute cannot be greater than or equal to the total amount of the operation (total_capital)',
            'total_capital.required'        => 'The :attribute field is required',
            'total_capital.max'             => 'The :attribute field is too long 255 characters maximum',
            'total_capital.integer'         => 'The :attribute field must be a number'
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            'code' => 422,
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
