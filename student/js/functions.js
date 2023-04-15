
function addScript(SRC){//jsの追加用関数
    var scpt= document.createElement("script");
    scpt.src =SRC;//jqueryのパスを指定
    document.body.appendChild(scpt);

}

function input_confirm(){//入力内容の確認ダイアログを表示
    var check = confirm("入力内容に間違いはありませんか？");
    if(check){
        return check;
    }else{
        return check;
    }
}

function sleep(sec){
    var nowsec =0;
    var id = setInterval(function(){
        nowsec++;

        if(nowsec>sec){
            clearInterval(id);//処理の終了
        }
    },1000);
}