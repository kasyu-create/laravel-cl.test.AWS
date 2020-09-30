<?php

namespace Tests\Feature;

use App\User;
//ログイン済み状態に関するテストを書く為。
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;
    //TestCaseクラスを継承したクラスでRefreshDatabaseトレイトを使用すると、データベースをリセットします。なぜそのような必要があるかは、教材2-4で
    
    public function testIndex()
    //PHPUnitでは、テストのメソッド名の先頭にtestを付ける必要があります。
    {
        $response = $this->get(route('articles.index'));
        //ここでの$thisは、TestCaseクラスを継承したArticleControllerTestクラスを指します。

        $response->assertStatus(200)
            ->assertViewIs('articles.index');
        //assertStatusメソッドは返されたレスポンスが指定した(200 = HTTP 200 OK はリクエストが成功した場合に返すレスポンスコード。)HTTPステータスコードを持っていることをアサートします。
        //assertViewIsメソッドで、どんなビューが使われたのかをテストすることができます(今回はarticles.indexが使われたかテスト)。
    }

    public function testGuestCreate()
    //Laravelでは、未ログイン状態のユーザーのことをゲスト(guest)と呼びます。そこで、テストメソッド名はtestGuestCreateとしました。
    {
        $response = $this->get(route('articles.create'));

        $response->assertRedirect(route('login'));
        //assertRedirectメソッドでは、引数として渡したURLにリダイレクトされたかどうかをテストします。route('login')は、ログイン画面のURLを返します。(サンプルアプリケーションのログイン画面のルーティングにはloginという名前を付けています)
    } 
    public function testAuthCreate()
    {

        // 1 「準備」→今回はテストに必要なUserモデル

        $user = factory(User::class)->create();
        //factory関数を使用することで、テストに必要なモデルのインスタンスを、ファクトリというものを利用して生成できます。
        //factory(User::class)->create()とすることで、ファクトリによって生成されたUserモデルがデータベースに保存されます。
        //また、createメソッドは保存したモデルのインスタンスを返すので、これが変数$userに代入されます。

        //factory関数を使用するには、あらかじめそのモデルのファクトリが存在する必要があります。database/factories/Userfactory.php
        
        // 2 「実行」 → ログインして記事投稿画面にアクセスすること

        $response = $this->actingAs($user)
            ->get(route('articles.create'));
        //ここでの$thisは、TestCaseクラスを継承したArticleControllerTestクラスを指します。
        //actingAsメソッドは、引数として渡したUserモデルにてログインした状態を作り出します。

        // 3 「検証」 レスポンスを検証する

        $response->assertStatus(200)
            ->assertViewIs('articles.create');
    }   
}
