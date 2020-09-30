<?php

namespace Tests\Feature;

use App\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function testIsLikedByNull()
    {
        $article = factory(Article::class)->create();

        //ここでは、factory(Article::class)->create()とすることで、ファクトリによって生成されたArticleモデルがデータベースに保存されます。

        $result = $article->isLikedBy(null);

        $this->assertFalse($result);
        //ここでの$thisは、TestCaseクラスを継承したArtcleTestクラスを指します。
        //assertFalseメソッドは、引数がfalseかどうかをテストします。
    }
}
