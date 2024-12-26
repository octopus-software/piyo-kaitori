<?php

namespace App\Http\Requests\Cart;


use App\Http\Requests\FormRequest;

class CartStoreRequest extends FormRequest
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
            'purchase_target_id' => 'required|exists:purchase_targets,id',
            'name' => 'required|string',
            'price' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'purchase_target_id.required' => '商品を選択してください',
            'purchase_target_id.exists' => '商品が見つかりません',
            'name.required' => '商品名は必須です',
            'name.string' => '商品名は文字列で入力してください',
            'price.required' => '価格は必須です',
            'price.integer' => '価格は整数で入力してください',
            'price.min' => '価格は0以上で入力してください',
            'quantity.required' => '数量は必須です',
            'quantity.integer' => '数量は整数で入力してください',
            'quantity.min' => '数量は1以上で入力してください',
        ];
    }
}
