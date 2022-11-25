// タブ押下時の読み込み
$('.target').click(function() {
    // パラメータを末尾につける
    window.location.href = "../controller/adminpage_controller.php" + "?adminpage_tab=" + this.id

    var scrollPos= $(document).scrollTop();
	localStorage.setItem('key',scrollPos);
});

$('.jump').click(function() {
    var scrollPos= $(document).scrollTop();
	localStorage.setItem('key',scrollPos);
});

// 読み込み時に画面がトップにいかないようにする
$(document).ready(function(){
	var pos = localStorage.getItem('key');
    $(window).scrollTop(pos);
	localStorage.clear();
});

// いいね押下時DB登録＆削除
let goodbtn = document.getElementsByClassName('contents__good');

for (let i = 0; i < goodbtn.length; i++) {
    goodbtn[i].addEventListener ('click', function() {

        var parent = goodbtn[i].parentNode;
        var type = parent.children[1].value;
        var good_id = parent.children[2].value;
        var target_id = parent.children[3].value;

        // 非同期
        let xhr = new XMLHttpRequest();

        if (goodbtn[i].firstElementChild.classList.contains('goldstar')) {

            xhr.onload=function(){
                goodbtn[i].firstElementChild.classList.remove('goldstar');
                goodbtn[i].firstElementChild.classList.add('whitestar');
                goodbtn[i].firstElementChild.animate({
                    transform: "rotateX(0deg)"
                },
                {
                    fill:"forwards"
                }
                );
            }
        }
        else {
            xhr.onload=function(){
                goodbtn[i].firstElementChild.classList.remove('whitestar');
                goodbtn[i].firstElementChild.classList.add('goldstar');
                goodbtn[i].firstElementChild.animate({
                    transform: "rotateX(360deg)"
                },
                {
                    fill:"forwards",
                    duration: 500
                }
                );
            }
        }

        xhr.open('POST', '../controller/adminpage_controller.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=UTF-8");
        xhr.send('type=' + encodeURIComponent(type) + '&' +'target_id=' + encodeURIComponent(target_id) + '&' +'good_id=' + encodeURIComponent(good_id));
    })
}
