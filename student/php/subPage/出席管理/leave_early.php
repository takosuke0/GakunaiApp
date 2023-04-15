<?php

//現在時刻が早退可能な時間内か確認
function Get_TimeTable($pdo,$class)
{
    global $message;

    try{
        //自分のクラスの時間割テーブルを取得
        $sql = "SELECT * FROM `{$class}`";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $timeTable = $stmt->fetchall(PDO::FETCH_ASSOC);

        foreach ($timeTable as $column ){
            //現在時刻が学校の登下校時間内か確認
            if(InTime_School(reset($timeTable),end($timeTable))){
                //学校の授業時間内に早退可能か確認
                if(InTime_Study($column)){
                    //授業時間のレコードを返す
                    return $column;
                }
            }else{
                $message = "早退できませんでした。学校の登下校時間外です";
                return;
            }
        }
        //学校の登下校時間内に早退可能
        return "";
    }catch (PDOException $e) {
        header('Location: ../error_page.php');
        exit;
    }
}

//現在時刻が学校の登下校時間内か確認
function InTime_School($r_timeTable,$e_timeTable)
{
    //現在時刻を取得
    $current_time = new DateTimeImmutable();

    //DateTimeに変換
    $startTime = new DateTimeImmutable($r_timeTable['start_time']);
    $endingTime = new DateTimeImmutable($e_timeTable['ending_time']);

    //フォーマット(秒数を比較対象から外すため)
    $current_time = $current_time->format('H:i');
    $startTime = $startTime->format('H:i');
    $endingTime = $endingTime->format('H:i');

    //現在時刻が学校の登下校時間内か確認
    if($startTime <= $current_time && $current_time < $endingTime){
        return true;
    }else{
        return false;
    } 
}

//現在時刻が授業時間内か確認
function InTime_Study($column)
{
    //現在時刻を取得
    $current_time = new DateTimeImmutable();

    //DateTimeに変換
    $startTime = new DateTimeImmutable($column['start_time']);
    $endingTime = new DateTimeImmutable($column['ending_time']);

    //フォーマット(秒数を比較対象から外すため)
    $current_time = $current_time->format('H:i');
    $startTime = $startTime->format('H:i');
    $endingTime = $endingTime->format('H:i');

    //現在時刻が授業時間内か確認;
    if($startTime <= $current_time && $current_time < $endingTime){
        return true;
    }else{
        return false;
    }
}

//現在日時が平日か確認
function Get_Week()
{
    global $message,$day_of_week;

    $week = date('w');
    switch($week){
        case 1:
            $day_of_week = "月曜日";
            break;
        case 2:
            $day_of_week = "火曜日";
            break;
        case 3:
            $day_of_week = "水曜日";
            break; 
        case 4:
            $day_of_week = "木曜日";
            break;
        case 5:
            $day_of_week = "金曜日";
            break;
    }
    
    //現在日時が平日か確認
    if(isset($day_of_week)){
        return true;
    }else{
        $message = "早退できませんでした。今日は休日です";
        return false;
    }
}

//現在日時が平日であれば、曜日に応じたデータを取得する
function Get_Subject($timeTable)
{
    global $message;

    $subject = "";
    $week = date('w');
    switch($week){
        case 1:
            $subject = $timeTable['subjects_id_monday'];
            break;
        case 2:
            $subject = $timeTable['subjects_id_tuesday'];
            break;
        case 3:
            $subject = $timeTable['subjects_id_wednesday'];
            break;
        case 4:
            $subject = $timeTable['subjects_id_thursday'];
            break;
        case 5:
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
    //現在時刻の授業に既に出席している場合、更新する
    if(Log_Check($pdo,$user,$timeTable)){
        Update($pdo,$user,$timeTable,$subject,LEAVE_EARLY);
    }else{
        //出席していない場合、追加する
        Insert($pdo,$user,$timeTable['times_id'],$subject,LEAVE_EARLY);
    }
}

function Update($pdo,$user,$timeTable,$subject,$status){
    global $message;

    //現在時刻を取得
    $update_time = new DateTime();
    $update_time = $update_time-> format('Y-m-d H:i:s');

    //出席記録を更新する
    try{
        $sql = "UPDATE attendance_log 
        SET attendance_status = ?, update_time = ?
        WHERE DATE_FORMAT(update_time, '%Y-%m-%d') = DATE_FORMAT(now(), '%Y-%m-%d')
        AND students_id = ?
        AND timetable_times_id = ?
        AND attendance_status = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($status,$update_time,$user['student_id'],$timeTable['times_id'],ATTENDANCE));
        $message = "{$timeTable['times_id']}時限目、{$subject}の{$status}が完了しました。";   
    }catch (PDOException $e) {
        header('Location: ../error_page.php');
        exit;
    }
}

//pdo,グローバル変数,定数,ログチェックの関数
require_once('components/parts.php');
require_once('../Components/user_check.php');

//現在日時に早退していないか確認
if(!Status_Check($pdo_attendance,$user)){
    //現在日時が平日かチェック
    if(Get_Week()){
        //テーブル指定用にクラス名を変数に代入
        $my_class = $user['classes_id'];
        //現在時刻が早退可能な時間内か確認
        $timeTable = Get_TimeTable($pdo_tietable,$my_class);
        if(isset($timeTable)){
            //学校の授業時間内(配列型の戻り値)           
            if(is_array($timeTable)){
                //曜日に対応したデータを取得する
                $subject = Get_Subject($timeTable);
                //値がセットされていれば教科が設定されている
                if(isset($subject)){
                    Attendance_Log($pdo_attendance,$user,$timeTable,$subject);
                }
            //学校の登下校時間内
            }else{
                Insert($pdo_attendance,$user,NULL,NULL,LEAVE_EARLY);
            }  
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
    <title>早退</title>
</head>
<?php include("../Components/load_js.php")?>
<?php include("../Components/nav.php")?>

<body class="bg-lsBlue">
    <div class="container pt-5">
            <h3><?= $message ?></h3>
            <br>
        <a href="my_page.php" class="pt-5">マイページへ戻る</a>
    </div>

</body>
</html>
