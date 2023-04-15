<?php
session_start();

if(!empty($_SESSION["user"])){
    $user =$_SESSION["user"];
}else{
    header('Location: error_page.php');
    exit;      
}
    if(isset($_SESSION["errors"])){
        unset($_SESSION["errors"]);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/sample.css">
    <link rel="stylesheet" href="../../css/bootstrap.css">
    <title>トップ</title>
</head>

<script src ="../../js/jquery-3.6.0.min.js"></script>
<script src="../../js/popper.min.js"></script>
<script src="../../js/bootstrap.min.js"></script>
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
-->
<!--

//動作しない

<script type="text/javascript" src ="../../js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../../js/popper.min.js"></script>
<script type="text/javascript" src="../../js/bootstrap.bundle.js"></script>

-->
<body class="bg-lsBlue">
    
<span class="defBarColor fixed-top" style="width: 100%;height:4em;;"><h1>　</h1>
<nav class="container navbar navbar-expand-lg fixed-top navbar-light defBarColor">
    <h2><a class="" href="#" style="color:white;">学内アプリ</a></h2>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#contents" alia-controls="contents" alia-expanded="false" aria-label="navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="contents">

            <span class="row ref_992">
            <a class="nav-link row" href="出席管理/my_page.php" style="color:white;">マイページ</a>
            <a class="nav-link row ml-5" href="時間割/Timeable.php" style="color:white";>時間割</a>
            <a class="nav-link row ml-5" href="掲示板/board.php" style="color:white";>掲示板</a>
            <a href="sign_out.php" class="nav-link float-right ml-4">サインアウト</a>
            </span>
    
    </div>

</nav>
</span>
<br><br><br>


    <div class="container"> 

            <div id="contents1" class ="contents">
                <h3 id="Attendance_rate"class="subTitle_fadein">出席管理</h3><!--#Attendance_rate,#Timeable,#Bulletin_board,#Resevation-->
                <!--<p>マイページで出席に関する機能が使用できます。</p>-->
                <div class="explanation">
                    <!--<button id="explanation_title" class="explanation_title_attendancerate btn btn-secondaly" style="background: gray;color:white;">機能について</button>-->
                    <div class="explanation_text_attendancerate text-mono" id="explanation_text">
                        <p>現在の学期の出席率を確認できます。</p>
                        <p>また、マイページのから出席と早退を行うことが出来ます。</p>
                    </div>
                </div>

                <button class ="Attendance_rate_button btn" style="background: gray;color:white;"><a href="出席管理/my_page.php" class="color-white" style="color:white;">マイページへ</a></button>
            </div>
            <div id="contents2" class ="contents">
                <h3 id="Timeable"class="subTitle_fadein2">時間割</h3>
                <!--<p>今学期の出席率を確認出来ます。</p>-->
                <div class ="explanation">
                    <!--<button id="explanation_title" class="explanation_title_time btn btn-secondaly" style="background: gray;color:white;">機能について</button>-->
                    <div class="explanation_text_time" id="explanation_text">
                        <p>現在所属しているクラスの今学期の時間割が確認出来ます。</p>
                    </div>
                </div>
                <button class ="Timetable_button btn" style="background: gray;color:white;"><a href="時間割/Timeable.php" class="color-white" style="color:white;">時間割へ<a></button>
            </div>
    
            <div id="contents3" class ="contents">
                <h3 id="Bulletin_board"class="subTitle_fadein3">掲示板</h3>
                <!--<p>掲示板です。</p>-->

                <div class ="explanation">
                   <!-- <button id="explanation_title" class="explanation_title_board btn btn-secondaly" style="background: gray;color:white;">機能について</button>-->
                    <div class="explanation_text_board" id="explanation_text">
                        <p>タイトルと140字以内の文章を投稿できる掲示板です。投稿内容は直近10件まで確認することが出来ます。</p>
                        <p>過去の投稿内容は別ページから全て確認することが出来ます。</p>
                        <p>投稿に返信をすることも可能です。</p>
                    </div>
                </div>
                <button type="submit" class ="Bulletin_board_button btn" style="background: gray;color:white;"><a href="掲示板/board.php" style="color:white;">掲示板へ</a></button>
            </div>

    </div>
</body>
<script src="../../js/functions.js"></script>
    <script src ="../../js/exe.js"></script>
</html>