<?php

namespace App\Http\Requests\PurchaseTarget;


use App\Http\Requests\FormRequest;

class PurchaseTargetUpdateRequest extends FormRequest
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
            'jan_code' => 'required|string|max:13|unique:purchase_targets,jan_code,' . $this->route('id'),
            'max_quantity' => 'required|integer|min:1',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'name.string' => '商品名は文字列で入力してください',
            'jan_code.required' => 'JANコードを入力してください',
            'jan_code.string' => 'JANコードは文字列で入力してください',
            'jan_code.max' => 'JANコードは13文字以内で入力してください',
            'jan_code.unique' => 'このJANコードは既に登録されています',
            'max_quantity.required' => '数量を入力してください',
            'max_quantity.integer' => '数量は整数で入力してください',
            'max_quantity.min' => '数量は1以上で入力してください',
            'image_file.image' => '画像ファイルを選択してください',
            'image_file.mimes' => '画像ファイルはjpeg,png,jpg,gif形式で選択してください',
            'image_file.max' => '画像ファイルは2MB以内で選択してください',
        ];
    }
}
