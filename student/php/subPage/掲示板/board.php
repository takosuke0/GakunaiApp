<?php
    require_once "components/connect.php";
    require_once "components/functions.php";
    require_once('../Components/user_check.php');


    if(!empty($_SESSION["user"])){
        $user =$_SESSION["user"];
    }else{
        header('Location:../error_page.php');
        exit;      
    }
    $logs=[];

    if(empty($_SESSION["errors"])){
        $_SESSION["errors"]=[
            "title" => "",
            "text" => "",
            "reply" =>""
        ];

    }
  
    $db_cnt = get_rows_cnt($pdo);//データベースの総データ数
    $dlt_data_cnt = get_rows_cnt_notdlt($pdo);//データベース内の総データ数

    if($db_cnt[0]>0 && $dlt_data_cnt[0]>0){//データベースが空で無い場合
    $current_index =max_id($pdo)-10;//最大値の10個前
    var_dump($current_index);
    if($current_index<10){
        $current_index=0;
    }

        //直近10件を表示  削除されている投稿があった場合追加で取得
        $get_check =false;
            //テーブルの中が10個以下のときの処理を分ける

            //データの取得位置が2番目からになる
            //$logsの取得方法に問題がある  今週中に修正
            while(count($logs) <10){//要素が10個取得出来ていない場合  無理やり10個取得してしまうためエラーになる
                $arrays =[];
                $stmt = get_posts_desc($pdo);//投稿を取得

                while($data =$stmt->fetch()){
                    if($get_check){
                        $arrays[]=$data;
                    }else{
                        $logs[]=$data;//
                    }
                }

                if($db_cnt[0]<10 || $dlt_data_cnt[0]<10){break;}//データベースの要素数が10以下 データが削除されていない要素数が10以下
                $get_check =true;//取得が2回目以降か判断
                if($get_check){
                    $logs =array_merge($logs,$arrays);//配列を結合して$logに代入
                }

                $current_index-=10;//値の取得位置を10
            }

            //日付で並び替え　（配列内のdateを使う
            usort($logs, function($a, $b){
                return $a["date"] > $b["date"];//最新順にソート
            });
            krsort($logs);
            for($i = count($logs);$i>10;$i--){//配列の中身を10個にする
                array_pop($logs);//配列の末尾からpop  
            }
    }




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/sample.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">

    <title>掲示板</title>
</head>
<?php include("../Components/load_js.php")?>
<?php include("../Components/nav.php")?>

<body class="bg-lsBlue pad-t10">


    <div class="container mt-5">

    <h3 class="mb-5">   <span class ="spinner-grow text-info"></span>直近の投稿(最大10件まで表示)</h3>        <div class ="textview">
            <?php if($db_cnt[0]>0 && $dlt_data_cnt[0]>0):?>
                <div class ="post card">
                    <ul class="list-group">
                        <?php foreach($logs as $value):?>

                            <li class="list-group-item pb-5">
                                <span class="">
                                    <span class="ml-5 float-right board_date"><?=$value["date"]?></span>
                                    <span class="name_pos ml-2">投稿者:<?=$value["name"]?></span>
                                </span>
                                <div>
                                    <label class="board_title mt-3 ml-5 mb-5"style="display:inline-block;text-align: left;width: 85%;"><?=$value["title"]?></label>
                                </div>
                                    <span class="board_text ml-5 mt-4" style="display:inline-block;text-align: left;width: 85%;"><?=$value["text"]?></span>

                                <?php $reply = get_reply($pdo,$value["title"],$value["name"],$value["date"]);?>
                                <!--$replyから　日付を取得して投稿を区別-->

                                <!--投稿に返信がある場合表示する-->
                                <?php if(is_array($reply) && count($reply) >0):?>
                                    <!--ボタンのnameを定義-->
                                    <?php $date = new DateTime($value["date"]);
                                        $str_date = $date->format("Y-m-d-H-i-s");//string型に変換
                                    ?>
                                    <!--日付が入力されたときに、日付をコードに変換する（strtotime）-->
                                    <?php $btn_name = "reply_chack".strtotime($value["title"]).$value["name"].$str_date?><!--返信用のボタンを追加-->
                                    <?php $reply_name = "reply".strtotime($value["title"]).$value["name"].$str_date?>
                                    <?php arsort($reply,0)?>
                                    <div class="<?=$reply_name?> text-left list-group-item mt-3" style="border-radius: 60px;">
                                        <?php foreach($reply as $rp):?>
                                                    <p class="mb-1">返信者:<?=$rp["name"]?></p>
                                                    <p class="ml-5 mt-4 mb-4" style="display:inline-block;text-align: left;width: 85%;"><?=$rp["reply"]?></p>
                                                    <p class="mt-5 mr-5 text-right"><?=$rp["date"]?></p>
                                                    <p style="border-bottom: 0.005em solid black;"></p>
                                                    
                                        <?php endforeach;?>   
                                    </div>
                                    <button class="<?=$btn_name?> float-right btn btn-primary mt-4">返信一覧</button>
                                    <script>
                                        $(".<?=$reply_name?>").hide();//返信を隠す  
                                        $(".<?=$btn_name?>").click(function(){//
                                            $(".<?=$reply_name?>").toggle(450);//表示非表示を切替
                                        });
                                    </script>
                                <?php endif;?>



                            </li>

                            <?php endforeach;?>
                    </ul>

                </div>



        </div>


        <div class="float-right">
            <p class="mt-5"><a href="board_log.php">全ての投稿を見る</a></p>
        </div>
        <?php endif;?>

        <?php if($db_cnt[0]<=0 || $dlt_data_cnt[0]<=0):?>
            <div class="card" style="padding-top: 4em; padding-bottom: 4em;"><p class="ml-2">現在投稿はありません</p></div>
        <?php endif?>



            <div class="forms">
                <div class="post_form">
                    <form action="update.php" method="post" class ="mar_t10">
                        <div id="mar_t10" class="alert-primary pb-sm-1 pt-sm-5 mb-4 border_radius">
                            <h4 class="mb-5" style="margin-left: 10%;">掲示板に投稿</h4>
                            <div class="contents">
                                <div class="marl-10p">
                                    <label for="title">タイトル</label>

                                    <span style="color:red;" class ="mar-lef4e"><?=$_SESSION["errors"]["title"]?></span>

                                    <textarea name="title" id="title" cols="14" rows="2" maxlength = 28 class="form-control" style="width:45%;" name="username"></textarea><br>
                                </div>
                                <div class="marl-10p" style="width:100%;">
                                    <label for="text">投稿内容</label>
                                    <span style="color:red;" class ="mar-lef4e"><?=$_SESSION["errors"]["text"]?></span>
                                    <textarea rows="8" cols="20"  type="text" name="text" maxlength="140" class=" inputConfig form-control" id="text" style="width:80%;"></textarea>
                                </div>
                                <input type="hidden" name="board" value="true">
                            </div>
                            <button type="submit" class="mt-3 mar_b3 btn btn-info btn-pos btn-block marl-10p mt-5" name="btn" style="width:80%;" id ="board_submit" onclick="return input_confirm()">送信</button>

                        </div>
                    </form>
                </div>

                <?php if($db_cnt[0]>0 && $dlt_data_cnt[0]>0):?>
                <div class="reply_form">
                    <form action="board_reply.php" method="post" class ="mar_t10">
                        <div id="mar_t10" class="alert-primary pb-sm-1 pt-sm-5 mb-4 border_radius">
                            <h4 class="mb-5" style="margin-left: 10%;">投稿に返信</h4>
                            <div class="contents">
                                <div class="marl-10p">
                                    <label for="title">タイトル</label>

                                    <div>
                                    <select name="reply_data" id="" class="form-control bg-info text-white" style="width: 89%;">
                                    <!--タイトルタグを使って投稿を管理-->

                                    <?php foreach($logs as $title):?>
                                        <option value='<?=$title["title"]?>,<?=$title["name"]?>,<?=$title["date"]?>'>投稿者:<?=$title["name"];?>　タイトル:<?=$title["title"]?>　日時:<?=$title["date"]?></option>
                                    <?php endforeach;?>
                                    
                                    
                                    </select>

                                    </div>
                                    <br>
                                </div>
                                <div class="marl-10p" style="width:100%;">
                                    <label for="text">投稿内容</label>
                                    <span style="color:red;" class ="mar-lef4e"><?=$_SESSION["errors"]["reply"]?></span>
                                    <textarea rows="8" cols="20"  type="text" name="reply" maxlength="140" class=" inputConfig form-control" id="text" style="width:80%;"></textarea>
                                </div>

                                <input type="hidden" name="board" value="true">
                            </div>

                            <button type="submit" class="mt-3 mar_b3 btn btn-info btn-pos btn-block marl-10p mt-5" name="btn" style="width:80%;" id ="board_submit" onclick="return input_confirm()">送信</button>

                        </div>
                    </form>
                </div>

            </div>
            <button type="button" class="mt-3 mar_b3 btn btn-success btn-pos btn-block  mt-5 form_btn">投稿返信切替</button>
            <?php endif?>

    </div>
    <?php
        $_SESSION["errors"]=[
                    "title" => "",
                    "text" => "",
                    "reply" =>""
        ];
    ?>

</body>

    <script src="../../../js/check.js"></script>
    <script src="../../../js/exe.js"></script>
    <script src ="../../../js/functions.js"></script>
</html>