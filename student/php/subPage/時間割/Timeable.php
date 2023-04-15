<?php


//出席可能な時間割レコードを取得
function Get_TimeTable($pdo,$my_class)
{
    
    try{
        //自分のクラスの時間割テーブルを取得
        $sql = "SELECT * FROM `{$my_class}`";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $timeTable = $stmt->fetchall(PDO::FETCH_BOTH);
        return $timeTable;
    }catch (PDOException $e) {
        header('Location: ../error_page.php');
        exit;
    }
}

date_default_timezone_set("Asia/Tokyo");

//DB接続
require_once('../Components/user_check.php');
require_once('../Components/config.php');
require_once('../Components/connect.php');

//pdo変数
$pdo = TimeTable();

$header = ["時限","開始時間","終了時間","月","火","水","木","金"];
//テーブル指定用にクラス名を変数に代入
$my_class = $user['classes_id'];

$timeTable = Get_TimeTable($pdo,$my_class);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../../css/sample.css">
    <link rel="stylesheet" href="../../../css/bootstrap.css">  
    <title>Document</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="timetable.css?<?php echo date("YmdHis"); ?>">
    <title>時間割</title>
</head>
<body class="bg-lsBlue">
<?php include("../Components/load_js.php")?>
<?php include("../Components/nav.php")?>
    <br>

    <div class="container">
        <h1 class="ClassName"><?= $my_class ?></h1>
        <table class="mt-5 container"style="top:15%;">

            <!-- 縦列の繰り返 し-->
            <?php for ($parent = 0 ; $parent < count($timeTable) ; $parent++) : ?>
                <!-- ヘッダー　-->
                <tr>
                    <?php if ($parent == 0) : ?>
                        <?php for ($index = 0 ; $index < count($timeTable[$parent])/2 ; $index++) : ?>
                            <th style="width:10%";><?= $header[$index]?></th>
                        <?php endfor; ?>
                    <?php endif; ?>
                </tr>

                <!-- 横列の繰り返し -->

                <tr>
                    <?php for ($child = 0 ; $child < count($timeTable[$parent])/2 ; $child++) : ?>
                        <?php if($timeTable[$parent][$child] == NULL){$timeTable[$parent][$child] = "/";}?>
                        <td><?= $timeTable[$parent][$child]?></td>
                    <?php endfor; ?>
                </tr>
                
            <?php endfor; ?>

        </table>
    </div>
</body>
</html>