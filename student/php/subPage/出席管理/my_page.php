<?php

require_once('../Components/user_check.php');

//ボタン処理
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['attendance'])) {
        header('Location: attendance.php');
        exit;
    } else if(isset($_POST['leave_early'])) {
        header('Location: leave_early.php');
        exit;
    } else if(isset($_POST['attendance_rate'])){
        header('Location: attendance_rate.php');
        exit;
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
    <link rel="stylesheet" href="../../../css/sample.css">
    <title>マイページ</title>
</head>
<?php include("../Components/load_js.php")?>
<?php include("../Components/nav.php")?>
<br>
<body class="bg-lsBlue">
    <div class="">

            <div class="container">
                    <h3 class="mb-5 container mt-5" style="margin-left: -0.5em;">学生情報</h3>
                        <table class="table container table-borderless" style="font-size: larger; margin-left:10.75%;">
                            <th>クラス</th>
                            <th>生徒番号</th>
                            <th>ユーザー名</th>
                            <tr>
                                <td><?= $user['classes_id']?></td>
                                <td><?= $user['student_id']?></td>
                                <td><?= $user['student_name']?></td>
                            </tr>
                        </table>
                <form action="" method="post">
                <div class="row container justify-content-center" style="width:100%;position:fixed;top:70%;">
                        <button class="w-50 btn col-3 btn-primary mr-5 pt-3 pb-3" name="attendance" onClick="return confirm('出席しますか?')">出席</button>
                        <button class="w-50 btn col-3 btn-danger mr-5" name="leave_early"onClick="return confirm('早退しますか?')">早退</button>
                        <button class="w-50 btn col-3 btn-success mr-5" name="attendance_rate">出席率</button>

                </form>
            </div>
    </div>
</body>
</html>