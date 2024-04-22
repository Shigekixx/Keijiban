<?php
    //サーバーのMETHODがPOSTのときの処理だよっていう目印
    if ($_SERVER["REQUEST_METHOD"]==="POST") {

        $title = $_POST ["title"];  //タイトルのこと
        $news = $_POST ["news"];  //記事のこと
        $newsid = uniqid(); //IDを自動生成したもの
        $data1 = array($title,$news,$newsid); //それぞれの要素を配列にまとめたい
        
        // 制限値 タイトルを30文字以下にしたい
        $limitA= 30;
        // エラーメッセージ用変数
        $errMsg = '';
        // 入力された文字列の長さを取得する
        $titleLength = strlen($title);


        //どっちも中身が埋まっていない場合
        if(empty($title) && empty($news)){
            $errMsg = 'タイトル・本文が空欄です';
            echo $errMsg ;
        } else if (empty($title)){
            $errMsg = 'タイトルが空欄です';
            echo $errMsg;
        } else if(empty($news)){
            $errMsg = '本文が空欄です';
            echo $errMsg;
        } else if ($limitA < $titleLength ){    //タイトルが長すぎる場合
            $errMsg = 'タイトルは30文字以下で表示してください';
            echo $errMsg;
        } else {
            //主キーを保存する??

            //取り出した内容をファイルに保存する
            $fileA = fopen("news.csv", "a"); //ファイルを開く

            // ファイルに書き込む方式も考えるべし

            $string = implode(',' , $data1);
            fwrite( $fileA, $string ."\n");    //ファイルに書き込む
            fclose( $fileA );                //ファイルを閉じる

            //リロードで再度送信はこれで解消
            header("location:http://localhost:8888/");
            exit;
        }
    } else {

    }

    //タイトル・記事出力
    //読み込みたいファイルのpathを記述し、変数に代入
    $filenameA = 'news.csv';

    //読み込んだファイル内の全てのデータを取得し、変数に代入
    $contentA = file_get_contents($filenameA);

    

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">     
        <title>Document</title>


    <style>
            .dialog::backdrop {
            backdrop-filter: blur(8px);
        }

        .dialog {
            box-shadow: 0px 20px 36px 0px rgba(0, 0, 0, 0.6);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0;
            }
        }

        .dialog {
            display: block;
            position: fixed;
            inset-inline: 0;
            inset-block: 0;

            animation-name: fadeOut;
            animation-fill-mode: forwards;
            animation-duration: 200ms;
            animation-timing-function: ease-out;
        }

        .dialog[open] {
            animation-name: fadeIn;
            animation-fill-mode: forwards;
            animation-duration: 200ms;
            animation-timing-function: ease-out;
        }
        </style>

    </head>

    <body>

        <!-- //ナビゲーションバーのリンク -->
        <h1><a href="Post.php"> Laravel_News</a></h1>
        <h2>さぁ、新しいニュースを投稿しよう</h2>

        <form action = "./" method = "post" onSubmit="return confirmSubmit()">
            <label for ="title">タイトル</label>
            <input type ="text" id ="title" name ="title">
            <br>
            <label for ="news">投稿内容</label>
            <input type ="text" id ="news" name ="news">
            <br>
            <button id="openButton" type="button">投稿</button>
            <!-- 主キーとしてIDを取得したい -->
            <!-- <input type="hidden" id="postId" name="postId" value="newsid"/> -->


            <dialog id="modalDialog" class="dialog">
                <div id="dialog-container">
                    <header>
                    <div>本当に送信しますか？</div>
                    </header>
                    <form method="dialog">
                        <button type="submit" value="OK">Ok</button>
                        <button id="closeButton" type="button" value="CANCEL">Cancel</button>

                    </form>
                </div>
            </dialog>
        </form>

        <h1>投稿一覧</h1> 
        <!-- 投稿一覧での表示の仕方、ニュース詳細画面にリンクするためにどうすべきか -->
        <p><?php echo $contentA."\n";?> </p> 

        <script>
            const openButton = document.getElementById('openButton');
            const modalDialog = document.getElementById('modalDialog');

            // モーダルを開く
                openButton?.addEventListener('click', async () => {
                modalDialog.removeAttribute("style")

                modalDialog.showModal();
                // モーダルダイアログを表示する際に背景部分がスクロールしないようにする
                document.documentElement.style.overflow = "hidden";
            });
            
                const closeButton = document.getElementById('closeButton');

                // モーダルを閉じる
                closeButton?.addEventListener('click', () => {
                modalDialog.close();
                // モーダルを解除すると、スクロール可能になる
                document.documentElement.removeAttribute("style");
                });

                modalDialog.addEventListener("close", async(e) => {
                // アニメーションが終了すると、スタイルを適用する
                await waitDialogAnimation(e.target)
                modalDialog.style.display = "none"
            })

            // アニメーションが完了するまで待機する
                const waitDialogAnimation = (dialog) => Promise.allSettled(
                Array.from(dialog.getAnimations()).map(animation => animation.finished)
            );

            // // まず隠しフィールド要素を取得
            // const hiddenField = document.getElementById('news-id');
            // // 値をセット
            // hiddenField.value = 
                
        </script>  
    </body>

</html>