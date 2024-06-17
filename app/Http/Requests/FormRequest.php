<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class FormRequest extends BaseFormRequest
{
    /**
     *
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        if (request()->expectsJson()) {
            // APIの場合はJSONでエラーを返す
            $response = response()->json([
                'status' => 'error',
                'errors' => $validator->errors(),
            ], 422);

            throw new HttpResponseException($response);
        } else {
            // それ以外の場合はリダイレクト処理を行う
            $exception = $validator->getException();
            throw (new $exception($validator))
                ->errorBag($this->errorBag)
                ->redirectTo($this->getRedirectUrl());
        }
    }
}
