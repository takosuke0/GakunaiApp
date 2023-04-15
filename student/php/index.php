<?php
//DB接続
require_once('subPage/Components/config.php');
require_once('subPage/Components/connect.php');
$pdo = Attendance();

session_start();
session_regenerate_id();//セッションidを再発行

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
        header('Location: subPage/error_page.php');
        exit;
    }
}

//認証処理(POST送信)
$message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //サニタイズ、入力値確認
    $posts = check($_POST);
    //認証
    $user = auth($pdo, $posts['email'], $posts['password']);
    if ($user) {
        //セッションに登録
        $_SESSION['user'] = $user;
        //セレクトページにリダイレクト
        header('Location: subPage/index.php');
    }else{
        $message = "メールアドレス、またはパスワードが異なります";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>サインイン</title>
</head>
<body>
    <main class="d-flex justify-content-center">
        <div class="w-50 mt-3 p-5 bg-light">
            <form action="" method="post">
                <h3 class="h3 mb-3 fw-normal">サインイン</h3>
                <div class="error_message">
                    <?= $message ?>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" pattern="[a-zA-Z0-9._%&+-]+@[a-z0-9.-]+\.[a-z]{2,}$" minlength="6" maxlength="254" required>
                </div>
                <div class="mt-2">
                    <label for="password">パスワード</label>
                    <input type="password" name="password" class="form-control" id="password" pattern="^[a-zA-Z0-9!-/:-@¥[-`{-~]+$" title="空白を開けずに半角英数字、または記号で入力してください"　maxlength="255" required>
                </div>
                <div class="mt-4">
                    <button class="w-100 mt-2 btn btn-lg btn-primary">サインイン</button>
                </div>
            </form>
            <div class="mt-2">
                <a href="subPage/Forget_Pass/forget_pass.php">パスワードを忘れた場合</a>
            </div>
        </div>
    </main>
</body>

</html>