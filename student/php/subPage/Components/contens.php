
<?php
    $link =[
        "href" => "",
        "name" => ""
    ];
    $links =[];
    for($i =0;$i<count($links);$i++){

        $links[] =$link;
    }

    $links[0]["href"]="../出席管理/my_page.php";
    $links[1]["href"]="../時間割/Timeable.php";
    $links[2]["href"]="../掲示板/board.php";
//    $links[3]["href"]="../学内PC予約/Resevation.php";
    $links[0]["name"]="出席率";
    $links[1]["name"]="時間割 ";
    $links[2]["name"]="掲示板";
//    $links[3]["name"]="PC予約";

    echo '<div class="row M_bottom-5 defBarColor header_pos">';
    echo '<h1 class="title_pos"><a href="../index.php">学内アプリ</a></h1>';


    foreach($links as $item){
        echo '<a href="' .$item["href"].'" class="itembar">' .$item["name"]. '</a>';
    }
    echo '<span class="pos_R nav_white'.$user["student_name"].'</span>';

    echo '<span class="pos_R mar_t2"><a href=../sign_out.php>サインアウト</a></span>';
    
    



    echo "</div>";
