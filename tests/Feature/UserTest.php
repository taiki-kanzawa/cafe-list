<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\Feature\LoginTest;

class UserTest extends LoginTest
{
    // ユーザーのプロフィールの編集テスト
    
    // プロフィールの編集画面の表示テスト
    public function testGetUserEdit()
    {
        // ログイン画面の表示
        LoginTest::testGetLoginPage();
        
        // ログインの実行
        LoginTest::testLoginSuccess();
        
        // 認証ユーザーのプロフィール画面の表示
        $response = $this->get('/users/8');
        $response->assertStatus(200);
        
        // 認証ユーザーのプロフィール編集画面の表示
        $response = $this->get('/users/8/edit');
        $response->assertStatus(200);
    }
    
    // プロフィール編集のエラーテスト
    public function testUserEditError()
    {
        $this->testGetUserEdit();
        
        // テキストファイルの生成
        $text = UploadedFile::fake()->create('test.txt', 100);
        
        // プロフィールにテキストファイルと名前を空で更新を実行
        $this->put('/users/8', [
            'icon' => $text,
            'name' => ''
        ]);
        
        // エラーメッセージが表示されているか確認
        $response = $this->get('/users/8/edit');
        $response->assertSee('画像ファイルを選択してください。')
                 ->assertSee('画像ファイルの拡張子の内、jpeg,png,jpg,svgのいずれかを選択してください。')
                 ->assertSee('ユーザー名は必須項目です。');
                 
        // 最大文字数以上の名前と自己紹介を生成
        $name = str_repeat('abcde', 8);
        $content = str_repeat('abcde', 40);
                 
        // 名前と自己紹介を最大文字数以上の文字数で更新を実行
        $this->put('/users/8', [
            'name' => $name,
            'content' => $content
        ]);
        
        // エラーメッセージが表示されているか確認
        $response = $this->get('/users/8/edit');
        $response->assertSee('ユーザー名を35文字以内で入力してください。')
                 ->assertSee('自己紹介欄は191文字以内で入力してください。');
    }
    
    // プロフィールの編集テスト
    public function testUserEdit()
    {
        $this->testGetUserEdit();
        
        // 画像を生成
        $icon = UploadedFile::fake()->image('icon.jpg')->size(100);
        
        // プロフィールに画像と自己紹介を追加
        $response = $this->put('/users/8', [
            'icon' => $icon,
            'name' => 'test',
            'content' => 'ユーザーのプロフィールの編集テスト'
        ]);
        
        // icon.jpgがS3に保存されたことを確認
        Storage::disk('s3')->assertExists('/icon/icon.jpg');
        
        // DBに保存されたか確認
        $this->assertDatabaseHas('users', [
            'icon' => 'icon/icon.jpg',
            'name' => 'test',
            'content' => 'ユーザーのプロフィールの編集テスト'
        ]);
        
        // プロフィール画面に戻ったか確認
        $response->assertViewIs('users.show');
    }
}
