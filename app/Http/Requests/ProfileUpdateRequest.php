<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => [
                'required',
                'string',
                'email',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'nid' => [
                'required',
                'numeric',
                Rule::unique(User::class, 'nid')->ignore($this->user()->id),
            ],
            'phone' => [
                'required',
                'string',
                Rule::unique(User::class, 'phone')->ignore($this->user()->id),
            ],
        ];
    }
}
