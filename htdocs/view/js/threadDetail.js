// タブを押したときの判定
$('.target').click(function() {
    let url = new URL(window.location.href);
    let params = url.searchParams;
    // パラメータを末尾につける
    if(params.has('thread_id')){
        window.location.href = "../controller/threadDetail_controller.php?thread_id=" + params.get('thread_id') + "&res_tab=" + this.id
    }
});