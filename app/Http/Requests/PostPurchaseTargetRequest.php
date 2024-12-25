<?php

namespace App\Http\Requests;

class PostPurchaseTargetRequest extends FormRequest
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
            'amount' => 'required|integer|min:1',
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
            'amount.required' => '購入数は必須です',
            'amount.integer' => '購入数は整数で入力してください',
            'amount.min' => '購入数は1以上で入力してください',
            'image_file.image' => '画像ファイルを選択してください',
        ];
    }
}
