<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TransactionStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'regex:/^1$|^-1$/'],
            'amount' => ['required', 'numeric', function ($attribute, $value, $fail) {
                if($value == '0') {
                    $fail('Cannot be zero');
                }
            }],
            'description' => ['required', 'string'],
        ];
    }
}
