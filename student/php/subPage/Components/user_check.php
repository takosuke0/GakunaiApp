<?php

session_start();

if(isset($_SESSION['user'])){
    //ログインしたユーザーの情報を受け取る
    $user = $_SESSION['user'];
}else{
    header('Location: ../error_page.php');
    exit;      
}

?>