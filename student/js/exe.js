

$("document").ready(function(){
    /*
    $(".explanation_text_board").hide();
    $(".explanation_text_time").hide();
    $(".explanation_text_attendancerate").hide();
    */
    $(".reply").hide();
    //投稿　返信フォームを隠す
    $(".reply_form").hide();   
});

//説明文の表示切替
/*(".explanation_title_board").hover(
    function(){
        $(".explanation_text_board").show();
    },
    function(){
        $(".explanation_text_board").hide();
    }
);*/



/*
$(".explanation_title_board").click(function(){
    $(".explanation_text_board").fadeToggle("fast","linear");
});

$(".explanation_title_time").click(function(){
    $(".explanation_text_time").fadeToggle("fast","linear");
});

$(".explanation_title_attendancerate").click(function(){
    $(".explanation_text_attendancerate").fadeToggle("fast","linear");
});*/

//トップページのホバー
/*
$(".explanation_title_attendancerate").click(function(){
    $(".explanation_text_attendancerate").fadeToggle("slow","linear");
});

$(".explanation_title_time").click(function(){
    $(".explanation_text_time").fadeToggle("slow","linear");
});

$(".explanation_title_board").click(function(){
    $(".explanation_text_board").fadeToggle("slow","linear");
    
});*/

//返信の表示切替
$(".reply_check").click(function(){
    $(".reply").toggle();
})

$(".form_btn").click(function(){
    $(".post_form").fadeToggle("fast","linear");
    $(".reply_form").fadeToggle("fast","linear");
});

