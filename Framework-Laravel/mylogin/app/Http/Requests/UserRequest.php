<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
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
            'name'=>'required|min:3|max:255',
            'email'=>'required|email|unique:users',
            'password'=>[
                'required',
                'confirmed',
                $this->isPrecognitive() 
                    ? Password::min(8)
                    : Password::min(8)->uncompromised(), 
            ],
            
        ];
    }
}
