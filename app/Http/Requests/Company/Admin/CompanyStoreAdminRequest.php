<?php

namespace App\Http\Requests\Company\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CompanyStoreAdminRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:companies'],
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
