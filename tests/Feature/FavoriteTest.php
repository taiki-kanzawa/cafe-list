<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class FavoriteTest extends TestCase
{
    // お気に入りに登録するテスト
    public function testFavorite()
    {
        // 新規ユーザーの作成
        $user = factory(User::class)->create([
            'email' => 'test02@test.jp',
            'password' => bcrypt('test02')
        ]);
        
        // ログインページの表示
        $response = $this->get('login');
        $response->assertStatus(200);
        
        // ログインの実行
        $response = $this->post('login', [
            'email' => $user->email,
            'password' => 'test02'
        ]);
        
        // 認証されて、トップページにリダイレクトされたか確認
        $this->assertAuthenticated();
        $response->assertRedirect('/');
        
        // 投稿されたカフェが表示されているか確認
        $response = $this->get('/');
        $response->assertSee('dummycafe 新宿店')
                 ->assertSee('東京都新宿区')
                 ->assertSee('お気に入り');     // お気に入りボタンが表示されているか確認
        
        // お気に入りにする
        $response = $this->post('/cafes/6');
        
        // お気に入りに登録されたか確認
        $response->assertSee('お気に入り済み');
    }
}
