<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
  //Gmail 認証情報
  $host = 'smtp.gmail.com';
  $username = 'tako830293@gmail.com';//自分のGoogleアカウントのGmailアドレス
  $password = 'spqbparocwasocnk';//パスワード、もしくはアプリパスワード

  //差出人
  $from = 'tako830293@gmail.com';//自分のGoogleアカウントのGmailアドレス
  $fromname = 'admin';

  //宛先
  $to = $student_email;
  $toname = $student_name;

  //件名・本文
  $subject = '認証コード';
  $body = "認証コードは{$auth_password}です";

  //メール設定
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->Host = $host;
  $mail->Username = $username;
  $mail->Password = $password;
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;
  $mail->CharSet = "utf-8";
  $mail->Encoding = "base64";
  $mail->setFrom($from, $fromname);
  $mail->addAddress($to, $toname);
  $mail->Subject = $subject;
  $mail->Body    = $body;

  //メール送信
  $mail->send();

} catch (Exception $e) {
  header('Location: ../error_page.php');
  exit;
}