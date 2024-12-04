<?php

namespace App\Http\Requests;

use App\Models\VaccineCenter;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VaccineRegistrationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'vaccine_center' => ['required', Rule::exists(VaccineCenter::class, 'id'),
                function ($attribute, $value, $fail) {
                    $center = VaccineCenter::find($value);

                    if ($center->daily_limit <= 0) {
                        $fail('The selected center is currently full. Please try again tomorrow');
                    }
                },
            ],
            'scheduled_date' => ['required', 'date', 'after_or_equal:today',
                function ($attribute, $value, $fail) {
                    $date = Carbon::parse($value);

                    // Friday = 5, Saturday = 6
                    if (in_array($date->dayOfWeek, [5, 6])) {
                        $fail('You cannot register on Fridays or Saturdays.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'vaccine_center.required' => 'Please select a vaccine center.',
            'vaccine_center.exists' => 'The selected vaccine center does not exist.',
            'scheduled_date.required' => 'Please select a date for your vaccination.',
            'scheduled_date.after_or_equal' => 'The vaccination date must be today or later.',
        ];
    }
}
