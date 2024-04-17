<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <h1>NEWSPOST</h1>
        <h2>さぁ、新しいニュースを投稿しよう</h2>


        <form action="./" method="post">
            <label for ="title">タイトル</label>
            <input type ="text" id =title name ="title">
            <br>
            <label for ="news">投稿内容</label>
            <input type ="text" id =news name ="news">
            <br>
            <button type="submit">投稿</button>
        </form>
    </body>
</html>

<?php

//タイトル・記事入力
    $title = $_POST ["title"];
    $news = $_POST ["news"];  
    
    $str = $title.$news;

    //主キーを保存する


    //タイトル・記事保存
    $file = fopen("news.txt", "a"); 
    fwrite( $file, $str ."\n");     
    fclose( $file );    
    
    if($_SERVER["REQUEST_METHOD"]==="POST"){
        header("location: ./");
        exit;
    }
    
    //リロードした際にバグらないようにしよう

    //タイトル・記事出力

    //読み込みたいファイルのpathを記述し、変数に代入
    $filename = 'news.txt';

    //読み込んだファイル内の全てのデータを取得し、変数に代入
    $content = file_get_contents($filename);

    //取得したデータをHTMLで表示
    echo $content;

    


    //ニュース詳細画面へのリンク

    //ナビゲーションバーのリンク
?>

