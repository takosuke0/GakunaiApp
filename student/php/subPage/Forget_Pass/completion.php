<?php

session_start();

//SESSIONに生徒データがなければエラー
if(!isset($_SESSION['student'])){
    header('Location: ../error_page.php');
    exit;      
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <title>メールアドレスを忘れた場合</title>
</head>
<body>
    <main class="d-flex justify-content-center">
        <div class="w-50 mt-3 p-5 bg-light">
            <h3 class="h3 mb-3 fw-normal">パスワードを変更しました。</h3>
            <div>
                <a href="../sign_out.php">サインインページへ</a>
            </div>
        </div>

    </main>
</body>
</html>