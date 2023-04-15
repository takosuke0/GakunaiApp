<?php
//投稿データの取得
    function get_posts($pdo,$offset){
        $sql = "SELECT * FROM userlog WHERE delete_flag=0 ORDER BY id ASC LIMIT 10 OFFSET {$offset}";//削除されている投稿を飛ばす処理を追加(delete_postが1であれば飛ばして10件になるまで取得)
        $stmt=$pdo->query($sql);
        return $stmt;
        
    }

    //投稿データの取得(降順)
    function get_posts_desc($pdo){
        $sql = "SELECT * FROM userlog WHERE delete_flag=0 ORDER BY id DESC LIMIT 10";
        $stmt=$pdo->query($sql);
        return $stmt;
    }

    //idの最大の10個前を取得する関数
    function max_id($pdo){
        $sql = "SELECT max(id) AS id FROM userlog";
        $stmt=$pdo->query($sql);
        $max_id =$stmt->fetch();
        return $max_id["id"];
    }
    
    function get_title($pdo,$offset){
        //投稿の中からタイトル、name,日付を10件取得
        $sql = "SELECT name,title,date from userlog WHERE delete_flag=0 ORDER BY id ASC LIMIT 10 OFFSET {$offset}";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    }

    function get_reply($pdo,$title,$name,$date){//リプライテーブルから取得
        //受け取ったタイトル,name,日付が一致した投稿を取得
        $sql = "SELECT * from reply WHERE :title = title AND :post_user_name = post_user_name AND :distinationDate = distinationDate";//タイトルと投稿者が一致
        $stmt = $pdo->prepare($sql);
        $stmt->execute([":title" => $title,":post_user_name" => $name, ":distinationDate" => $date]);
        return $stmt->fetchAll();
    }
    function get_post_all($pdo){//削除済み投稿以外を全て取得する関数
        $sql = "SELECT * FROM userlog WHERE delete_flag=0 ORDER BY id DESC";//削除済みでない投稿を全て取得するsql
        $stmt=$pdo->query($sql);
        return $stmt;
    }
    function get_count($pdo){
        $sql = "SELECT count(*) as cnt FROM userlog WHERE delete_flag=0";//削除済みでない投稿を全て取得するsql
        $stmt=$pdo->query($sql);
        return $stmt->fetch();
    }
    function get_count_all($pdo){
        $sql = "SELECT count(*) as cnt FROM userlog";//削除済みでない投稿を全て取得するsql
        $stmt=$pdo->query($sql);
        return $stmt->fetch();
    }
    
    function get_rows_cnt($pdo){
        $sql ="SELECT count(*) FROM userlog";
        $stmt = $pdo->query($sql);
        return $stmt->fetch();
    }
    function get_rows_cnt_notdlt($pdo){
        $sql ="SELECT count(*) FROM userlog WHERE delete_flag=0";
        $stmt = $pdo->query($sql);
        return $stmt->fetch();
    }


?>