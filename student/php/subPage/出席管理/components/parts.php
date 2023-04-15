<?php

//出席状態をデータベースで記録、検索するための定数
define("ATTENDANCE","出席");
define("LEAVE_EARLY","早退");

//タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');

//DB接続
require_once('../Components/connect.php');

//pdo変数
$pdo_attendance = Attendance();
$pdo_tietable = TimeTable();


//処理結果をメッセージとして表示するための変数
global $message;

//曜日を格納する変数
global $day_of_week;


//現在日時で既に早退しているかのチェック
function Status_Check($pdo,$user)
{    
    global $message;
        
    //現在日時の早退記録を探す
    try{
        $sql = "SELECT * FROM attendance_log 
                WHERE DATE_FORMAT(update_time, '%Y-%m-%d') = DATE_FORMAT(now(), '%Y-%m-%d')
                AND students_id = ?
                AND attendance_status = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user['student_id'],LEAVE_EARLY));
        $data_log = $stmt->fetch(PDO::FETCH_ASSOC);
        //既に早退している記録があれば、trueを返す
        if ($data_log) {
            $message = "本日は早退済みです";
            return true;
        }else{
            return false;
        }
    }catch (PDOException $e) {
        header('../error_page.php');
        exit;
    }
}

//現在時刻の授業に既に出席しているかのチェック
function Log_Check($pdo,$user,$timeTable)
{
    try{
        $sql = "SELECT * FROM attendance_log 
                WHERE DATE_FORMAT(update_time, '%Y-%m-%d') = DATE_FORMAT(now(), '%Y-%m-%d')
                AND students_id = ?
                AND timetable_times_id = ?
                AND attendance_status = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user['student_id'],$timeTable['times_id'],ATTENDANCE));
        $data_log = $stmt->fetch(PDO::FETCH_ASSOC);
        //データを返す
        return $data_log;
    }catch (PDOException $e) {
        header('../error_page.php');
        exit;
    }
}

//出席、早退記録をデータベースに登録する
function Insert($pdo,$user,$timeTable,$subject,$status){
    global $day_of_week,$message;

    //現在時刻を取得
    $update_time = new DateTime();
    $update_time = $update_time-> format('Y-m-d H:i:s');

    try{
        $sql = "INSERT INTO attendance_log VALUES(id,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($user['student_id'],$user['classes_id'],$day_of_week,$timeTable,$subject,$status,$update_time));
        if(is_null($timeTable) && is_null($subject)){
            $message = "{$status}が完了しました。";   
        }else{
            $message = "{$timeTable}時限目、{$subject}の{$status}が完了しました。";   
        }
    }catch (PDOException $e) {
        header('Location: ../error_page.php');
        exit;
    }

}

