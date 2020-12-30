<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    // ログイン画面の表示のテスト
    public function testGetLoginPage()
    {
        $response = $this->get('login');
        $response->assertStatus(200);
    }
    
    // ログインエラーのテスト
    public function testLoginError()
    {
        // DBに保存されていないデータでログインを試みる
        $response = $this->post('login', [
            'email' => 'test02@test.com',
            'password' => 'test02',
        ]);
        
        // 認証されていないか確認
        $this->assertGuest();
    }
    
    // ログイン成功のテスト
    public function testLoginSuccess()
    {
        // RegisterTestで作成したユーザーでログイン実行
        $response = $this->post('login', [
            'email' => 'test@test.com',
            'password' => 'test01'
        ]);
        
        // 認証されているか確認
        $this->assertAuthenticated();
        
        // トップページにリダイレクトされたか確認
        $response->assertRedirect('/');
    }
}
