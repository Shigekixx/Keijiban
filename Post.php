<?php
    //タイトル・記事を出力
        //サーバーのMETHODがPOSTのときの処理だよっていう目印
        if ($_SERVER["REQUEST_METHOD"]==="POST") {

            $comment = $_POST ["comment"];  //コメントのこと
            $limitC = 50; //コメントの文字数制限
            $errMsg = ''; // エラーメッセージ用変数
            // 入力された文字列の長さを取得する
            $titleLength = strlen($title);
        }
    

    //コメントを入力

    //保存
    
    //出力
    
    //削除

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
        <h1>投稿詳細</h1>
        <p><?php echo $content;?> </p> 