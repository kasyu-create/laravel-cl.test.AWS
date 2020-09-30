<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use App\User;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body' => $faker->text(500),
        'user_id' => function() {
            return factory(User::class);
        }
    ];
    //ここでは、Fakerのtextメソッドを使用してランダムな文章を生成しています。$faker->text(500)と指定すると、以下のような最大500文字の文章が生成されます(ラテン語のようです)。
    //Fakerとは文章だけでなく、人名や住所、メールアドレスなどをランダムに生成してくれる、テストデータを作る時に便利なPHPのライブラリです。
});
