<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\Feature\LoginTest;

class CafeTest extends LoginTest
{
    // カフェの投稿ページの表示テスト
    public function testGetCafeCreate()
    {
        // ログイン画面の表示
        LoginTest::testGetLoginPage();
        
        // ログインの実行
        LoginTest::testLoginSuccess();
        
        // カフェの投稿ページの表示
        $response = $this->get('/cafes/create');
        $response->assertSuccessful();
    }
    
    // カフェの投稿エラーテスト
    public function testCafeCreateError()
    {
        $this->testGetCafeCreate();
        
        // 全て空で投稿を実行
        $this->post('/cafes', [
            'cafe_name' => '',
            'image' => [''],
            'address' => '',
            'wifi' => '',
            'electrical_outlet' => '',
            'smoking_seat' => '',
            'parking' => '',
            'meal_menu' => ''
        ]);
        
        // エラーメッセージが表示されているか確認
        $response = $this->get('/cafes/create');
        
        // 表示されるエラーメッセージ
        $errorMessages = [
            '店名は必須項目です。',
            '画像ファイルは必須項目です。',
            '住所は必須項目です。',
            'ラジオボタン（Wi-Fi）は選択必須です。',
            'ラジオボタン（コンセント）は選択必須です。',
            'ラジオボタン（喫煙席）は選択必須です。',
            'ラジオボタン（駐車場）は選択必須です。',
            '食事メニュー :は必須項目です。'
        ];
        foreach ($errorMessages as $errorMessage) {
            $response->assertSee($errorMessage);
        }
        
        // 表示されないエラーメッセージ
        $dontErrorMessages = [
            '画像ファイルを選択してください。',
            '画像ファイルの拡張子の内、jpeg,png,jpg,svgのいずれかを選択してください。',
            '画像ファイルは、20000KB以下のファイルを選択してください。'
        ];
        foreach ($dontErrorMessages as $dontErrorMessage) {
            $response->assertDontSee($dontErrorMessage);
        }
        
        
        // ここから画像以外のファイルをPOSTしたときのエラーテスト
        // 画像ファイルとPDFファイルを生成
        $image_01 = UploadedFile::fake()->image('dummy.jpg');
        $pdf = UploadedFile::fake()->create('dummy.pdf');
                 
        // 画像を1つPDFファイルで投稿を実行
        $this->post('/cafes', [
            'cafe_name' => 'dummycafe 新宿店',
            'image' => [$image_01, $pdf],
            'address' => '東京都新宿区',
            'wifi' => 'あり',
            'electrical_outlet' => 'あり',
            'smoking_seat' => 'なし',
            'parking' => 'なし',
            'meal_menu' => '軽食のみ'
        ]);
        
        // エラーメッセージが表示されているか確認
        $response = $this->get('/cafes/create');
        
        // 表示されるエラーメッセージ
        $response->assertSee('画像ファイルを選択してください。')
                 ->assertSee('画像ファイルの拡張子の内、jpeg,png,jpg,svgのいずれかを選択してください。');
        
        // 表示されないエラーメッセージ
        $dontErrorMessages = [
            '店名は必須項目です。',
            '画像ファイルは必須項目です。',
            '画像ファイルは、20000KB以下のファイルを選択してください。',
            '住所は必須項目です。',
            'ラジオボタン（Wi-Fi）は選択必須です。',
            'ラジオボタン（コンセント）は選択必須です。',
            'ラジオボタン（喫煙席）は選択必須です。',
            'ラジオボタン（駐車場）は選択必須です。',
            '食事メニュー :は必須項目です。'
        ];
        foreach ($dontErrorMessages as $dontErrorMessage) {
            $response->assertDontSee($dontErrorMessage);
        }
        
        
        // ここから画像ファイルの大きさが20000KBを超えたファイルをPOSTしたときのエラーテスト
        // ファイルサイズが20000KBの画像ファイルを生成
        $image_02 = UploadedFile::fake()->image('error_image.jpg')->size(20001);
        
        // 上記のファイルで投稿を実行
        $this->post('/cafes', [
            'cafe_name' => 'dummycafe 新宿店',
            'image' => [$image_02],
            'address' => '東京都新宿区',
            'wifi' => 'あり',
            'electrical_outlet' => 'あり',
            'smoking_seat' => 'なし',
            'parking' => 'なし',
            'meal_menu' => '軽食のみ'
        ]);
        
        // エラーメッセージが表示されているか確認
        $response = $this->get('/cafes/create');
        
        // 表示されるエラーメッセージ
        $response->assertSee('画像ファイルは、20000KB以下のファイルを選択してください。');
        
        // 表示されないエラーメッセージ
        $dontErrorMessages = [
            '画像ファイルは必須項目です。',
            '画像ファイルを選択してください。',
            '画像ファイルの拡張子の内、jpeg,png,jpg,svgのいずれかを選択してください。'
        ];
        foreach ($dontErrorMessages as $dontErrorMessage) {
            $response->assertDontSee($dontErrorMessage);
        }
    }
    
    // カフェの投稿成功テスト
    public function testCafeCreate()
    {
        $this->testGetCafeCreate();
        
        // 画像ファイルを複数生成
        $cafe_01 = UploadedFile::fake()->image('cafe_01.jpg');
        $cafe_02 = UploadedFile::fake()->image('cafe_02.jpg');
        $cafe_03 = UploadedFile::fake()->image('cafe_03.jpg');
        
        // バリデーションに引っかからない内容で投稿を実行
        $response = $this->post('/cafes', [
            'cafe_name' => 'dummycafe 新宿店',
            'image' => [$cafe_01, $cafe_02, $cafe_03],
            'address' => '東京都新宿区',
            'wifi' => 'あり',
            'electrical_outlet' => 'あり',
            'smoking_seat' => 'なし',
            'parking' => 'なし',
            'meal_menu' => '軽食のみ'
        ]);
        
        // カフェの画像がS3に保存されたか確認
        Storage::disk('s3')->assertExists('/cafe_images/cafe_01.jpg');
        Storage::disk('s3')->assertExists('/cafe_images/cafe_02.jpg');
        Storage::disk('s3')->assertExists('/cafe_images/cafe_03.jpg');
        
        // 画像ファイル以外がDBのcafesテーブルに保存されたか確認
        $this->assertDatabaseHas('cafes', [
            'cafe_name' => 'dummycafe 新宿店',
            'address' => '東京都新宿区',
            'wifi' => 'あり',
            'electrical_outlet' => 'あり',
            'smoking_seat' => 'なし',
            'parking' => 'なし',
            'meal_menu' => '軽食のみ'
        ]);
        
        // 画像ファイルがcafe_imagesテーブルに保存されたか確認
        $this->assertDatabaseHas('cafe_images', [
            'image' => ['cafe_images/cafe_01.jpg', 'cafe_images/cafe_02.jpg', 'cafe_images/cafe_03.jpg'],
        ]);
        
        // リダイレクトされたか確認
        $response->assertRedirect('/');
    }
}
