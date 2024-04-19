<?php
    //コメントを入力
        //サーバーのMETHODがPOSTのときの処理だよっていう目印
        if ($_SERVER["REQUEST_METHOD"]==="POST") {

            $comment = $_POST ["comment"];  //コメントのこと
            $limitC = 50; //コメントの文字数制限
            $errMsg = ''; // エラーメッセージ用変数
            // 入力された文字列の長さを取得する
            $titleLength = strlen($title);
        
            //どっちも中身が埋まっていた場合
            if(empty($comment)){
                $errMsg = 'コメントが空欄です';
                echo $errMsg ;
            } else if ($limitC < $titleLength ){    //タイトルが長すぎる場合
                $errMsg = 'タイトルは50文字以下で表示してください';
                echo $errMsg;
            } else {
                //主キーを保存する??

                //取り出した内容をファイルに保存する
                $fileB= fopen("comment.txt", "a"); //ファイルを開く
                fwrite( $fileB, $comment ."\n");     //ファイルに書き込む
                fclose( $fileB );                //ファイルを閉じる

                //リロードで再度送信はこれで解消
                header("location:http://localhost:8888/Post.php");
                exit;
        }
    } else {

    }

    //コメント出力
    //読み込みたいファイルのpathを記述し、変数に代入
    $filenameB = 'comment.txt';

    //読み込んだファイル内の全てのデータを取得し、変数に代入
    $contentB = file_get_contents($filenameB);





    //タイトル・記事出力
    //読み込みたいファイルのpathを記述し、変数に代入
    $filenameC = 'news.txt';

    //読み込んだファイル内の全てのデータを取得し、変数に代入
    $contentC = file_get_contents($filenameC);

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
        <h1><a href="index.php"> Laravel_News</a></h1>
        <h1>投稿詳細</h1>

    <!-- 投稿内容の表示 -->
        <p><?php echo $contentC;?> </p> 


    <!-- コメント入力フォーム -->
        <form action = "./" method = "post">
            <label for ="comment">コメント</label>
            <input type ="text" id ="comment" name ="comment">
            <br>
            <button type="submit">投稿</button>
        </form>



    <!-- コメントの表示 -->
    <!-- コメントと記事をリンクさせたい 表示方法も考えたい -->
    <p><?php echo $contentB;?> </p> 

    </body>

</html>