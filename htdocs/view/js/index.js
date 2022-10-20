// タブを押したときの判定
$('.target').click(function() {
    // パラメータを末尾につける
    if(location.href.match('keyword')){
        window.location.href = "../controller/index_controller.php" + location.search + "&tab=" + this.id
    }else{
        window.location.href = "../controller/index_controller.php" + "?tab=" + this.id
    }
});