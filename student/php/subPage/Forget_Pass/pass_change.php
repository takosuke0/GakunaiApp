<?php

//サニタイズ(XSS対策)
function check($posts)
{
    foreach ($posts as $column => $post) {
        $posts[$column] = htmlspecialchars($post, ENT_QUOTES, 'UTF-8');
    }
    return $posts;
}

//パスワードを変更
function Update_Pass($pdo,$email,$password)
{
    try{
        $sql = "UPDATE students 
        SET password = ? WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($password,$email));
    }catch (PDOException $e) {
        header('Location: ../error_page.php');
        exit;
    }
}

//DB接続
require_once('../Components/connect.php');

//pdo変数
$pdo = Attendance();

//エラーメッセージ用の変数
$message = "";

//セッション開始
session_start();

//SESSIONに生徒データがあれば取得
if(isset($_SESSION['student'])){
    $student = $_SESSION['student'];
}else{
    header('Location: ../error_page.php');
    exit;      
}

//postデータを受け取る
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //サニタイズ
    $posts = check($_POST);  
    //パスワードが再入力したものと一致している場合
    if(strcmp($posts['password'],$posts['password_check']) == 0){
        //パスワードをハッシュ化
        $posts["password"] = password_hash($posts['password'], PASSWORD_DEFAULT);

        //パスワードを変更
        Update_Pass($pdo,$student['email'],$posts['password']);
        header('Location: completion.php');
        exit;
    }else{
        $message = "パスワードが異なります";
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
                <h3 class="h3 mb-3 fw-normal">新しいパスワードを入力してください</h3>
                <div class="error_message">
                    <?= $message ?>
                </div> 
                <div class="mt-2">
                    <label for="password">パスワード</label>
                    <input type="password" name="password" class="form-control" id="password" maxlength="255" pattern="^[a-zA-Z0-9!-/:-@¥[-`{-~]+$" title="空白を開けずに半角英数字、または記号で入力してください" required>
                </div>
                <div class="mt-2">
                    <label for="password_check">パスワード（再入力）</label>
                    <input type="password" name="password_check" class="form-control" id="password_check"　maxlength="255" pattern="^[a-zA-Z0-9!-/:-@¥[-`{-~]+$" title="空白を開けずに半角英数字、または記号で入力してください" required>
                </div>
                <div class="mt-4">
                    <button class="w-100 btn btn-lg btn-primary">完了</button>
                </div>       
            </form>
            <div class="mt-2">
                <a href="auth.php">戻る</a>
            </div>
        </div>
    </main>    
</body>
</html>
