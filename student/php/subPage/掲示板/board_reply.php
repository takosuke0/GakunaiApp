<?php
    require_once "components/connect.php";
    session_start();
    //POSTデータからタイトルと返信を受け取る。
    //タイトルに対応づけて返信をreplyテーブルに保存
    //返信先の日付を取得する処理を追加
    $explode_data=htmlspecialchars($_POST["reply_data"]);
    $reply_data = explode(",",$explode_data);//返信先タイトルと名前と日付
    $current_page = $_SESSION["current_page"];
    $reply = htmlspecialchars($_POST["reply"]);//返信内容
    $reply_user = htmlspecialchars($_SESSION["user"]["student_name"]);//返信者のユーザ名用のカラムを追加する
    $_SESSION["errors"]=[
        "title" => "",
        "text" => "",
        "reply"=>""
    ];
    //データベースに返信が登録されない
    //

    $pattern="^(\s|　)+$";//空白文字の検索パターン
    //入力値が空の場合の処理

    if(mb_ereg_match($pattern,$_POST["title"])){
        $_SESSION["errors"]["title"] = "タイトルが入力されていません";
    }
    if(mb_ereg_match($pattern,$_POST["text"])){
        $_SESSION["errors"]["text"] ="本文が入力されていません";
    }
    if(mb_ereg_match($pattern,$reply) || strlen($reply)<=0){
        $_SESSION["errors"]["reply"]="返信が入力されていません";
        $_SESSION["errors"]["title"] = "";
        $_SESSION["errors"]["text"] ="";
    }


    if(mb_ereg_match($pattern,$reply) || strlen($reply)<=0){//処理が切り替わっていない
        $_SESSION["errors"]["title"] = "";
        $_SESSION["errors"]["text"] ="";
        if(isset($_SESSION["current_page"]) && !$_POST["board"]=="true"){
            $crn = $_SESSION["current_page"];
            header("Location:board_log.php?page_num={$crn}");
            return;
        }else{
            header("Location: board.php");
            return;
        }
    }

    /*$_SESSION["errors"]=[
        "title" => "",
        "text" => ""
    ];
    if($_POST["board"]){
        $_SESSION["errors"]=[
            "title" => "",
            "text" => ""
        ];
    }*/

    $_SESSION["reply"] = true;

    $sql = "INSERT INTO reply(title,post_user_name,name,reply,distinationDate) VALUES(:title,:post_user_name,:name,:reply,:distinationDate)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([":title" => $reply_data[0],":post_user_name"=>$reply_data[1],":name"=>$reply_user,":reply" => $reply, ":distinationDate" => $reply_data[2]]);

    if(isset($_SESSION["current_page"]) && !$_POST["board"]=="true"){
        $crn = $_SESSION["current_page"];
        header("Location:board_log.php?page_num={$crn}");
    }else{
        header("Location:board.php");
    }

    



?>