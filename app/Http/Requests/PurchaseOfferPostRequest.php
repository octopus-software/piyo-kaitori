<?php

namespace App\Http\Requests;


class PurchaseOfferPostRequest extends FormRequest
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
            '*.purchase_target_id' => 'required|exists:purchase_targets,id',
            '*.price' => 'required|integer|min:0',
            '*.amount' => 'required|integer|min:1',
            '*.evidence_url' => 'required|url'
        ];
    }
}
