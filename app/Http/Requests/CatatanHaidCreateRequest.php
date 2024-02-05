<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CatatanHaidCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() != null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'start_date' => ['required', 'max:100'],
            'end_date' => ['required', 'max:100'],
            'cycle_length' => ['required', 'integer'],
            'period_length' => ['required', 'integer'],
            'start_prediction_date' => ['required', 'max:100'],
            'end_prediction_date' => ['required', 'max:100'],
            'status' => ['required', 'max:100'],
            'reminder_active' => ['required', 'boolean'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response([
            "errors" => $validator->getMessageBag(),
        ], 400));
    }
}
