<?php

//サニタイズ(XSS対策)、入力値が空でないか確認
function check($posts)
{
    foreach ($posts as $column => $post) {
        $posts[$column] = htmlspecialchars($post, ENT_QUOTES, 'UTF-8');
    }
    return $posts;
}

function auth($pdo, $email, $password)
{
    //SQL準備
    try{
        $sql = "SELECT * FROM students WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        //Emailを文字列でバインド(SQLインジェクション対策)
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        //実行
        $stmt->execute();
        //結果を1行取得
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //もしユーザがいたら、パスワードを検証してかえす
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
    }catch (PDOException $e) {
        header('Location: ../error_page.php');
        exit;
    }
}

//DB接続
require_once('../Components/connect.php');

//pdo変数
$pdo = Attendance();

session_start();

//SESSIONに認証コードと生徒データがあれば取得
if(isset($_SESSION['password']) && isset($_SESSION['student'])){
    //認証コード取得
    $auth_password = $_SESSION['password'];
}else{
    header('Location: ../error_page.php');
    exit;      
}

//認証処理(POST送信)
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //サニタイズ、入力値確認
    $posts = check($_POST);

    //認証コード照合
    if($auth_password == $posts['auth_password']){
        header('Location: pass_change.php');
        exit;
    }else{
        $message = "認証コードが異なります";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/style.css">
    <title>メールアドレスを忘れた場合</title>
</head>
<body>
    <main class="d-flex justify-content-center">
        <div class="w-50 mt-3 p-5 bg-light">
            <form action="" method="post">
                <h3 class="h3 mb-3 fw-normal">メールアドレスに送信された認証コードを<p>入力してください<p></h3>
                <div class="error_message">
                    <?= $message ?>
                </div>
                <div>
                    <label for="auth">認証コード</label>
                    <input type="password" name="auth_password" class="form-control" id="auth" pattern="^[a-zA-Z0-9!-/:-@¥[-`{-~]+$" title="空白を開けずに半角英数字、または記号で入力してください" required>
                </div>
                <div class="mt-4">
                    <button class="w-100 btn btn-lg btn-primary">送信</button>
                </div>
            </form>
            <div class="mt-2">
                <a href="forget_pass.php">戻る</a>
            </div>
        </div>
    </main>
</body>
</html>