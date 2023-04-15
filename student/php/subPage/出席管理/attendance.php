<?php

//出席可能な時間割レコードを取得
function Get_TimeTable($pdo,$class)
{
    global $message;

    try{
        //自分のクラスの時間割テーブルを取得
        $sql = "SELECT * FROM `{$class}`";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $timeTable = $stmt->fetchall(PDO::FETCH_ASSOC);

        foreach ($timeTable as $column ) {
            //カラム内から開始時間と終了時間を取得
            $startTime = new DateTimeImmutable($column['start_time']);
            $endingTime = new DateTimeImmutable($column['ending_time']);
            //授業時間を取得
            $studyTime = $endingTime->diff($startTime)->format('%H:%i:%s');
            //InTime関数がtrueの場合         
            if(InTime($studyTime,$startTime,$endingTime)){
                //出席可能な時限のレコードを返す
                return $column;
            }
        }
        $message = "出席できませんでした。授業開始時間から10分以内に出席ボタンを押してください";
        return;
    }catch (PDOException $e) {
        header('Location: ../error_page.php');
        exit;
    }
}

//現在時刻が出席可能な時間か確認
function InTime($studyTime,$startTime){    
    //studyTimeを分数に変換
    $Arry=explode(":",$studyTime);
    $hour=$Arry[0]*60;//時間→分
    $seconds=round($Arry[2]/60,2);//秒→分
    $minutes=$hour+$Arry[1]+$seconds;//分にまとめる
    
    //startTimeを分数に変換
    $st = $startTime->format('H:i:s');
    $stArry=explode(":",$st);
    $st_hour=$stArry[0]*60;//時間→分
    $st_seconds=round($stArry[2]/60,2);//秒→分
    $st_minutes=$st_hour+$stArry[1]+$st_seconds;//分にまとめる
     
    //授業開始時間+授業時間の内の2割を*60して秒数に変換
    $gt_seconds= ($st_minutes + ($minutes*GRACE_NUM))*60;

    //秒数をdate型に変換
    $graceTime = date("H:i:s",mktime(0,0,$gt_seconds));

    //date型をDateTime型に変換
    $graceTime = new DateTimeImmutable($graceTime);

    //現在時刻を取得
    $current_time = new DateTimeImmutable();

    //フォーマット(秒数を比較対象から外すため)
    $startTime = $startTime->format('H:i');
    $graceTime = $graceTime->format('H:i');
    $current_time = $current_time->format('H:i');

    //現在時刻が授業開始時間以上、授業経過時間2割以下でtrue
    if($startTime <= $current_time && $current_time <= $graceTime){
        return true;
    }else{
        return false;
    }
}

//現在日時が平日であれば、曜日に応じたデータを取得する
function Get_Subject($timeTable)
{
    global $message,$day_of_week;

    $subject = "";
    $week = date('w');
    switch($week){
        case 1:
            $day_of_week = "月曜日";
            $subject = $timeTable['subjects_id_monday'];
            break;
        case 2:
            $day_of_week = "火曜日";
            $subject = $timeTable['subjects_id_tuesday'];
            break;
        case 3:
            $day_of_week = "水曜日";
            $subject = $timeTable['subjects_id_wednesday'];
            break;
        case 4:
            $day_of_week = "木曜日";
            $subject = $timeTable['subjects_id_thursday'];
            break;
        case 5:
            $day_of_week = "金曜日";
            $subject = $timeTable['subjects_id_friday'];
            break;
    }
    
    //時間割に教科が設定されている、なおかつ平日の場合
    if($subject){
        return $subject;
    }else{
        $message = "出席できませんでした。この時間は授業が設定されていません";
        return;
    }
}

//出席記録の確認、登録
function Attendance_Log($pdo,$user,$timeTable,$subject)
{
    global $message;
    //現在時刻の授業に既に出席している場合、終了する
    if(Log_Check($pdo,$user,$timeTable)){
        $message = "{$timeTable['times_id']}時限目、{$subject}の出席は既に完了しています。";
    }else{
        Insert($pdo,$user,$timeTable['times_id'],$subject,ATTENDANCE);
    }
}

//pdo,グローバル変数,定数,ログチェックの関数
require_once('components/parts.php');
require_once('../Components/user_check.php');

//授業時間の2割を取得するための定数
define("GRACE_NUM",0.2);

//テーブル指定用にクラス名を変数に代入
$my_class = $user['classes_id'];

//現在日時に早退していないか確認
if(!Status_Check($pdo_attendance,$user)){
    //時間割レコードを取得
    $timeTable = Get_TimeTable($pdo_tietable,$my_class);
    //現在時刻が出席可能な時間か確認
    if(isset($timeTable)){
        //曜日に対応したデータを取得する
        $subject = Get_Subject($timeTable);
        //値がセットされていれば平日とする
        if(isset($subject)){
            //出席
            Attendance_Log($pdo_attendance,$user,$timeTable,$subject);
        }
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
    <title>出席</title>
</head>

<?php include("../Components/load_js.php")?>
<?php include("../Components/nav.php")?>

<body class="bg-lsBlue">
    <div class="container pt-5">
        <h3><?= $message ?></h3>
        <a href="my_page.php">マイページへ戻る</a>
    </div>

</body>
</html>

