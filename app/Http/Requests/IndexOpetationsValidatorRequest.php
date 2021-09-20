<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class IndexOpetationsValidatorRequest extends FormRequest
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
            'user_id'                => 'required|integer',
            'dateFrom'          => 'required|date|date_format:Y-m-d',
            'dateTo'            => 'required|date|date_format:Y-m-d'
        ];
    }
    public function all($keys = NULL){
        return array_replace_recursive(
            parent::all(),
            $this->route()->parameters()
        );
    }
    public function messages()
    {
        return [
            'user_id.required'            => 'The :attribute field is required',
            'dateFrom.required'           => 'The :attribute field is required',
            'dateFrom.date'               => 'The :attribute is not a valid date (YYYY-MM-DD)',
            'dateFrom.date_format'        => 'The :attribute is not a valid date (YYYY-MM-DD)',
            'dateTo.required'             => 'The :attribute field is required',
            'dateTo.date'                 => 'The :attribute is not a valid date (YYYY-MM-DD)',
            'dateTo.date_format'          => 'The :attribute is not a valid date (YYYY-MM-DD)',

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
