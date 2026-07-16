<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GenerateVoucherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'id' => [
                'required',
                'string',
                'max:50',
            ],

            'flightNumber' => [
                'required',
                'string',
                'regex:/^(?:[A-Z]{2}|[A-Z]\d|\d[A-Z])\d{1,4}$/',
            ],

            'date' => [
                'required',
                'date_format:Y-m-d',
            ],

            'aircraft' => [
                'required',
                'exists:aircraft_types,name',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Crew Name is required.',
            'name.string' => 'Crew Name must be a valid text.',
            'name.max' => 'Crew Name may not be greater than 255 characters.',

            'id.required' => 'Crew ID is required.',
            'id.string' => 'Crew ID must be a valid text.',
            'id.max' => 'Crew ID may not be greater than 50 characters.',

            'flightNumber.required' => 'Flight Number is required.',
            'flightNumber.string' => 'Flight Number must be a valid text.',
            'flightNumber.regex' => 'Flight Number must be a valid IATA flight number (e.g. GA402, QZ204, 5Y1234, SQ1).',

            'date.required' => 'Flight Date is required.',
            'date.date_format' => 'Flight Date must be in YYYY-MM-DD format.',

            'aircraft.required' => 'Aircraft Type is required.',
            'aircraft.exists' => 'Selected Aircraft Type is invalid.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Crew Name',
            'id' => 'Crew ID',
            'flightNumber' => 'Flight Number',
            'date' => 'Flight Date',
            'aircraft' => 'Aircraft Type',
        ];
    }
}
