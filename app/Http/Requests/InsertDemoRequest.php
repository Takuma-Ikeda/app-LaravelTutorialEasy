<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsertDemoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // データの受け渡しを許可する
        // false のままだと “This action is unauthorized.” が発生する
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // バリデーションルールを設定する
        return [
                'username' => 'required',
                'mail'     => 'required|email',
                'age'      => 'required|numeric',
            ];
    }

    public function messages()
    {
        // バリデーションメッセージを設定する
        return [
            "required" => "必須項目です。",
            "email"    => "メールアドレスの形式で入力してください。",
            "numeric"  => "数値で入力してください。",
        ];
    }
}
