<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
        return [
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',    // バリデーション（作りかけ）//
            'name' => 'required|max:35',
            'content' => 'nullable|max:191',
        ];
    }
    
    public function messages()
    {
        return [
            'icon.image' => '画像ファイルを選択してください。',
            'icon.mimes' => '画像ファイルの拡張子の内、jpeg,png,jpg,svgのいずれかを選択してください。',
            'icon.max' => '画像ファイルは、2048KB以下のファイルを選択してください。',
            'name.required' => 'ユーザー名は必須項目です。',
            'name.max' => 'ユーザー名を35文字以内で入力してください。',
            'content.max' => '自己紹介欄は191文字以内で入力してください。',
        ];
    }
}
