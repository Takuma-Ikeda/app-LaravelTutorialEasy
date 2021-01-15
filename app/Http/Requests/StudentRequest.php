<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'name'  => 'required',
            'email' => 'required|email',
            'tel'   => 'required|regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/',
        ];
    }

    public function messages()
    {
        // バリデーションメッセージを設定する
        return [
            "required"  => "必須項目です。",
            "email"     => "メールアドレスの形式で入力してください。",
            "tel.regex" => "電話番号の形式で入力してください。",
        ];
    }
}
