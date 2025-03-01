<?php

namespace App\Http\Requests\Company\Admin;

use App\Models\Company;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CompanyUpdateAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(Company::class)->ignore($this->route('id'))],
            'address' => ['required', 'string', 'max:255'],
            'representative_name' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255'],
            'line_id' => ['string', 'nullable', 'max:255'],
            'secondhand_dealer_license_number' => ['required', 'string', 'max:255'],
            'send_address' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '企業名は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'address.required' => '住所は必須です。',
            'representative_name.required' => '代表者名は必須です。',
            'tel.required' => '電話番号は必須です。',
            'secondhand_dealer_license_number.required' => '古物商許可証番号は必須です。',
            'send_address.required' => '送付先住所は必須です。',
        ];
    }
}
