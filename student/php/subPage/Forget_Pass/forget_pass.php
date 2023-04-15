<?php

//メールアドレス認証
function auth($pdo, $email)
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
        //もしユーザがいたらかえす
        if ($user) {
            return $user;
        }
    }catch (PDOException $e) {
        header('Location: ../error_page.php');
        exit;
    }
}

//認証コード生成
function create_password()
{
	$shuffle = str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz0123456789');
	$password = substr(str_shuffle($shuffle), 0, 4);// 先頭4桁をランダムパスワードとして使う

    // 大文字小文字の英字と数字が混在するかどうかをチェック
	// 混在すれば、パスワードを返し
	if( preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$/',$password) ){ // コーディング量が少ない反面、読みづらい、理解しにくい正規表現
		return $password;
	}
	// 混在しなければ、もう一度再帰関数を呼び出し
	else{
		return create_password();
	}
}

//DB接続
require_once('../Components/connect.php');

//pdo変数
$pdo = Attendance();

//エラーメッセージ用の変数
$message = "";

//認証処理(POST送信)
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    //入力したメールアドレスのユーザー情報を取得
    $user = auth($pdo, $_POST['email']);
    
    //入力したメールアドレスが登録されていれば
    if ($user){
        
        //認証コード作成
        $auth_password = create_password();
        //生徒のメールアドレスを取得
        $student_email = $user['email'];
        //生徒の名前を取得
        $student_name = $user['student_name'];
        
        //メール送信
        require_once('components/mail.php');
        
        //セッションスタート
        session_start();
        $_SESSION['password'] = $auth_password;
        $_SESSION['student'] = $user;

        header('Location: auth.php');
        exit;
    }else{
        $message = "入力したメールアドレスは登録されていません";
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
                <h3 class="h3 mb-3 fw-normal">メールアドレスを入力してください</h3>
                <div class="error_message">
                    <?= $message ?>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" minlength="6" maxlength="254" pattern="[a-zA-Z0-9._%&+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                </div>
                <div class="mt-4">
                    <button class="w-100 btn btn-lg btn-primary">送信</button>
                </div>
            </form>
            <div class="mt-2">
                <a href="../../index.php">戻る</a>
            </div>
        </div>
    </main>
</body>
</html>