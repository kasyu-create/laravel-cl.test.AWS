<?php

namespace Tests\Feature;

use App\Article;
use App\User;
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
    public function testIsLikedByTheUser()
    {
        $article = factory(Article::class)->create();
        //1行目では、ファクトリで生成したArticleモデルをデータベースに保存するとともに、インスタンスを変数$aticleに代入しています。
        $user = factory(User::class)->create();
        //2行目も同様に、ファクトリで生成したUserモデルをデータベースに保存するとともに、インスタンスを変数$userに代入しています。
        $article->likes()->attach($user);
        //上記のコードでは、記事に「いいね」をしていることになります。
        $result = $article->isLikedBy($user);
        //ここでは、Articleクラスのインスタンスが代入された$articleで、isLikedByメソッドを使用しています。
        $this->assertTrue($result);
        //assertTrueメソッドは、引数がtrueかどうかをテストします。
    }
    public function testIsLikedByAnother()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();
        $another = factory(User::class)->create();
        //ここでは、ファクトリで生成した各モデルをデータベースに保存するとともに、インスタンスを変数に代入しています。Userモデルについては2つ生成し、それぞれ$userと$anotherに代入しています。
        $article->likes()->attach($another);
        //ここでは、変数$anotherに代入されたUserモデルのインスタンスが、$articleをいいねしている状態を作り出しています。
        $result = $article->isLikedBy($user);
        //ここでは、Articleクラスのインスタンスが代入された$articleで、isLikedByメソッドを使用しています。
        //引数として$userを渡し、その戻り値が変数$resultに代入されます。
        //$anotherは、この$articleをいいねしているユーザーですが、$userは、この$articleをいいねしていないユーザーです。
        //そのため、$resultにはfalseが代入されるはずです。
        $this->assertFalse($result);
        //assertFalseメソッドは、引数がfalseかどうかをテストします。
    }
}
