<?php
    //サーバーのMETHODがPOSTのときの処理だよっていう目印
    if ($_SERVER["REQUEST_METHOD"]==="POST") {

        $title = $_POST ["title"];  //タイトルのこと
        $news = $_POST ["news"];  //記事のこと
        $str = $title.$news;    //それぞれをまとめたもの


        // 制限値 タイトルを30文字以下にしたい
        $limit = 30;
        // エラーメッセージ用変数
        $errMsg = '';
        // 入力された文字列の長さを取得する
        $titleLength = strlen($title);


        //どっちも中身が埋まっていた場合
        if (isset($str)){

            //主キーを保存する??

            //取り出した内容をファイルに保存する
            $file = fopen("news.txt", "a"); //ファイルを開く
            fwrite( $file, $str ."\n");     //ファイルに書き込む
            fclose( $file );                //ファイルを閉じる

            //リロードで再度送信はこれで解消
            header("location:http://localhost:8888/");
            exit;

        //タイトルが長すぎる場合

        }else  if ($limit < $titleLength ) {
            $errMsg = 'タイトルは30文字以下で表示してください';
        }      

        //空欄が存在する場合
        else {                     
            $errMsg = '空欄の項目があります';
        }  

    }else { 
        //タイトル・記事出力
        //読み込みたいファイルのpathを記述し、変数に代入
        $filename = 'news.txt';

        //読み込んだファイル内の全てのデータを取得し、変数に代入
        $content = file_get_contents($filename);

        //取得したデータをHTMLで表示
        echo $content;

    }


    //ニュース詳細画面へのリンク

    //ナビゲーションバーのリンク




?>

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
            <input type ="text" id ="title" name ="title">
            <br>
            <label for ="news">投稿内容</label>
            <input type ="text" id ="news" name ="news">
            <br>
            <button type="submit">投稿</button>

        <h1>投稿一覧</h1>


        </form>
    </body>
</html>
