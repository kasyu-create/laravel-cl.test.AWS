<?php

namespace Tests\Feature;

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
}
