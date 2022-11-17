// タブを押したときの判定
$('.target').click(function() {
    // パラメータを末尾につける
    window.location.href = "../controller/mypage_controller.php" + "?mypage_tab=" + this.id
});

// function deleteconfirm_thre(){
//     var res = confirm("選択したスレッドを削除しますか？");
//     if(res == true){
//         window.location.href = "../controller/mypage_controller.php?delete_flag=1";
//     }else{
//         window.alert("キャンセルされました");
//     }
// }

// function deleteconfirm_res(){
//     var res = confirm("選択したレスを削除しますか？");
//     if(res == true){
//         window.location.href = "../controller/mypage_controller.php?delete_flag=2";
//     }
// }