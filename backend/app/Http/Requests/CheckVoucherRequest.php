<?php

namespace App\Http\Requests;

// use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CheckVoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this reques
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'flightNumber' => [
                'required',
                'string',
                'max:6',
                'regex:/^(?:[A-Z]{2}|[A-Z]\d|\d[A-Z])\d{1,4}$/',
            ],

            'date' => [
                'required',
                'date_format:Y-m-d',
            ],
        ];

    }

    public function messages(): array
    {
        return [
            // Flight Number
            'flightNumber.required' => 'Flight Number is required.',
            'flightNumber.string' => 'Flight Number must be a valid text.',
            'flightNumber.max' => 'Flight Number may not be greater than 6 characters.',
            'flightNumber.regex' => 'Flight Number must be a valid IATA flight number (e.g. GA402, QZ204, 5Y1234, SQ1).',

            // Flight Date
            'date.required' => 'Flight Date is required.',
            'date.date_format' => 'Flight Date must be in YYYY-MM-DD format.',
        ];
    }

    public function attributes(): array
    {
        return [
            'flightNumber' => 'Flight Number',
            'date' => 'Flight Date',
        ];
    }
}
