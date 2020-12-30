<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    public function testRegister()
    {
        // アカウント登録ページの表示に成功したか確認
        $response = $this->get('signup');
        $response->assertStatus(200);
        
        // アカウントの作成
        $response = $this->post('signup', [
            'name' => 'test',
            'email' => 'test@test.com',
            'password' => 'test01',
            'password_confirmation' => 'test01'
        ]);
        
        // 認証されているか確認
        $this->assertAuthenticated();
        
        // トップページにリダイレクトされたか確認
        $response->assertRedirect('/');
    }
}
