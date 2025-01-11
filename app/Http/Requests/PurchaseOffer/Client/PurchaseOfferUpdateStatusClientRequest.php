<?php

namespace App\Http\Requests\PurchaseOffer\Client;

use App\Models\PurchaseOffer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PurchaseOfferUpdateStatusClientRequest extends FormRequest
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
            'status' => ['required', 'integer', Rule::in(array_values(PurchaseOffer::STATUS))],
            'shipped_date' => ['nullable', 'date', 'after_or_equal:today', 'required_if:status,3'],
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'ステータスを選択してください。',
            'status.integer' => 'ステータスは数値で入力してください。',
            'status.in' => 'ステータスが不正です。',
            'shipped_date.required_if' => '商品発送日を入力してください。',
            'shipped_date.date' => '商品発送日は日付で入力してください。',
            'shipped_date.after_or_equal' => '商品発送日は今日以降の日付を入力してください。',
        ];
    }
}
