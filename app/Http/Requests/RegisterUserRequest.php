<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class RegisterUserRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|unique:users,email',
            'password' => ['required', 'string', RulesPassword::min(6)->mixedCase()->numbers()],
        ];
    }


    public function messages(): array
    {
        return [
            'name.unique' => 'A felhasználónév már foglalt.',
            'email.unique' => 'Az email cím már foglalt.',
        ];
    }
}
