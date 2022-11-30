// タブを押したときの判定
$('.target').click(function() {
    let url = new URL(window.location.href);
    let params = url.searchParams;
    // パラメータを末尾につける
    if(params.has('category')&&params.has('keyword')){
        window.location.href = "../controller/index_controller.php?category=" + params.get('category') + "&keyword=" + params.get('keyword')+ "&tab=" + this.id
    }else if(params.has('category')){
        window.location.href = "../controller/index_controller.php?category=" + params.get('category') + "&tab=" + this.id
    }else if(params.has('keyword')){
        window.location.href = "../controller/index_controller.php?keyword=" + params.get('keyword') + "&tab=" + this.id
    }else if(params.has('terms1')){
        window.location.href = "../controller/index_controller.php?terms1=" + params.post('terms1') + "&tab=" + this.id
    }else{
        window.location.href = "../controller/index_controller.php" + "?tab=" + this.id
    }
});