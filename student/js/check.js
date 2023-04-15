function inputCheck_rate(){
    var student_id = document.getElementById("student_id_get")
    var id_value=student_id.value;
    var student_pass = document.getElementById("student_pass_get")
    var pass_value=student_pass.value;
    //id用の正規表現
    var id_regex = /^2[0-9]{5,}/;
    var pass_regex =/[a-zA-Z0-9]{8,16}/;
    //どのエラーに引っかかっているか

    //入力値判定
    var result_id =id_value.match(id_regex);
    var result_pass = pass_value.match(pass_regex);
    if(!result_id){
        console.log(id_value)
        console.log(result_id)
        alert("正しい学籍番号を入力してください")
        return result_id
    }
    if(!result_pass){
        alert("不正なパスワードです")
        return result_pass
    }
    console.log(result_id)
    return true
}
//掲示板の入力値チェック
function board_check(){

    if($(".title").val() == "" || $(".title").val().length >10){
        alert("タイトルの内容に問題があります");
        return false;
    }
    if(!$(".text").val() == "" || $(".text").val().length >10){
        alert("テキストの内容に問題があります");
        return false;
    }

    return true;
}