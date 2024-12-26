<?php

namespace App\Http\Requests\PurchaseTarget;

use App\Http\Requests\FormRequest;

class PurchaseTargetStoreRequest extends FormRequest
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
            'name' => 'required|string',
            'jan_code' => 'required|string|max:13|unique:purchase_targets,jan_code',
            'max_quantity' => 'required|integer|min:1',
            'image_file' => 'nullable|image',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '商品名は必須です',
            'name.string' => '商品名は文字列で入力してください',
            'jan_code.required' => 'JANコードは必須です',
            'jan_code.string' => 'JANコードは文字列で入力してください',
            'jan_code.max' => 'JANコードは13文字以内で入力してください',
            'jan_code.unique' => 'そのJANコードは既に登録されています',
            'max_quantity.required' => '購入数は必須です',
            'max_quantity.integer' => '購入数は整数で入力してください',
            'max_quantity.min' => '購入数は1以上で入力してください',
            'image_file.image' => '画像ファイルを選択してください',
        ];
    }
}
