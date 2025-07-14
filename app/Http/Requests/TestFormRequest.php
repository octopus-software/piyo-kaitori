<?php

namespace App\Http\Requests;

class TestFormRequest extends FormRequest
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
            // 'name'=>'string|alpha:ascii',
            'name'=>'string',
            'email'=>'email',
            // 'email_verified_at'=>'date',
        ];
    }
}
