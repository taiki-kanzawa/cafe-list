<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CafesRequest extends FormRequest
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
            'cafe_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:20000',
            'address' => 'required',
            'wifi' => 'required',
            'electrical_outlet' => 'required',
            'smoking_seat' => 'required',
            'parking' => 'required',
            'meal_menu' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'cafe_name.required' => '店名は必須項目です。',
            'image.required' => '画像ファイルは必須項目です。',
            'image.image' => '画像ファイルを選択してください。',
            'image.mimes' => '画像ファイルの拡張子の内、jpeg,png,jpg,svgのいずれかを選択してください。',
            'image.max' => '画像ファイルは、20000KB以下のファイルを選択してください。',
            'address.required' => '住所は必須項目です。',
            'wifi.required' => 'ラジオボタン（Wi-Fi）は選択必須です。',
            'electrical_outlet.required' => 'ラジオボタン（コンセント）は選択必須です。',
            'smoking_seat.required' => 'ラジオボタン（喫煙席）は選択必須です。',
            'parking.required' => 'ラジオボタン（駐車場）は選択必須です。',
            'meal_menu.required' => '食事メニュー :は必須項目です。',
            
        ];
    }
}
