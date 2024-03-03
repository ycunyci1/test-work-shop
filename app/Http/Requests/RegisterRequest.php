<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'string|min:3|required',
            'email' => 'email|unique:users,email|required',
            'password' => 'min:6|string|required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.min' => 'Имя не может быть короче 3 символов',
            'name.required' => 'Имя обязательно для заполнения',
            'email.email' => 'Некорректный email',
            'email.unique' => 'Email уже занят',
            'email.required' => 'Email обязателен для заполнения',
            'password.min' => 'Пароль не может быть короче 6 символов',
            'password.required' => 'Пароль не может быть пустым',
        ];
    }
}
