<?php
//タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

//DB接続
require_once('../Components/connect.php');
//ユーザーのログイン状態をチェック
require_once('../Components/user_check.php');

//pdo変数
$pdo_attendance = Attendance();

$header = ["教科","出席率"];

$message="出席率一覧";

//出席率データを取得
$attendance_rate = Get_Attendance_rate($pdo_attendance,$user);
if(empty($attendance_rate)){
    $message = "出席率が更新されていません";
}

//1週間以内の出席率データを教科ごとに1つずつ取得
function Get_Attendance_rate($pdo,$user)
{        
    try{
        $sql = "SELECT * FROM attendance_rate
                WHERE DATE_FORMAT(update_time, '%Y-%m-%d') >= (DATE_FORMAT(now(), '%Y-%m-%d') - INTERVAL 7 DAY)
                AND students_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user['student_id']));
        $attendance_rate = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //配列を初期化
        $array = array();
        foreach($attendance_rate as $rate){
            if(empty($array)){
              $array += array($rate['id'] => $rate);
            }
        
            if(!empty($array)){
                foreach($array as $key => $value){
                    //同じ教科の出席率データが存在したら
                    if($value['timetable_subjects_id'] == $rate['timetable_subjects_id']){
                        //直近に更新されたデータに置き換え
                        $value_date = new DateTime($value['update_time']);
                        $rate_date = new DateTime($rate['update_time']);
                        //rate_dateの時間のほうが新しい場合
                        if($value_date < $rate_date){
                            //データを最新のものに置き換える
                            $array[$key] = $rate;
                            break;
                        }
                    //同じ教科が存在しないまま配列が最後まで到達したら
                    }else{
                        if ($key == array_key_last($array)){
                            $array += array($rate['id'] => $rate);
                        }
                    }
                }
            }   
        }
        return $array;
    }catch (PDOException $e) {
        header('../error_page.php');
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
    <link rel="stylesheet" href="../../../css/sample.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">
    <link rel="stylesheet" href="rate.css">
    <title>出席率</title>
</head>
<body class="bg-lsBlue">
<?php include("../Components/load_js.php")?>
<?php include("../Components/nav.php")?>
<div class="container">

    <h3 class="mt-5"><?= $message ?></h3>
    <table class="mt-5 table container" style="top:15%;">
        <?php foreach($attendance_rate as $key => $value): ?>
            <!-- ヘッダー　-->
            <?php if ($key == array_key_first($attendance_rate)): ?>
                <tr class="table-info">
                    <?php for ($index = 0 ; $index < 2 ; $index++): ?>
                        <th style="width:10%"; class="text-dark"><?= $header[$index]?></th>
                    <?php endfor; ?>
                </tr>
            <?php endif; ?>
            <!-- データ -->
            <tr class="table-light">
                <td><?= $value['timetable_subjects_id']?></td>
                <td><?= $value['rate']?></td>
            </tr>
        <?php endforeach; ?>
     </table>
     <a href="my_page.php" class="pt-5">マイページへ戻る</a>
</div>

</body>
</html>