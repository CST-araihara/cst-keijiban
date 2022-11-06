// パスワードマスク
document.addEventListener('DOMContentLoaded', function(event) {

    const targetElement = document.getElementById('inputPassword');
    const triggerElement = document.getElementById('inputCheckbox');

    triggerElement.addEventListener('change', function(event) {
        if ( this.checked ) {
            targetElement.setAttribute('type', 'text');
        } else {
            targetElement.setAttribute('type', 'password');
        }
    }, false);

}, false);

// パスワードマスク
document.addEventListener('DOMContentLoaded', function(event) {

    const retargetElement = document.getElementById('reinputPassword');
    const retriggerElement = document.getElementById('reinputCheckbox');

    retriggerElement.addEventListener('change', function(event) {
        if ( this.checked ) {
            retargetElement.setAttribute('type', 'text');
        } else {
            retargetElement.setAttribute('type', 'password');
        }
    }, false);

}, false);

// 画像表示
function imgPreview(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    var preview = document.getElementById('preview');
    var previewImage = document.getElementById('previewImage');

    if (previewImage != null) {
        preview.removeChild(previewImage);
    }
    else if (preview != null) {
        preview.innerHTML ="";
    }
    reader.onload = function(event) {
        var img = document.createElement('img');
        img.setAttribute('src',reader.result);
        img.setAttribute('id','previewImage');
        preview.appendChild(img);
    };

    reader.readAsDataURL(file);
}

// 画像リセット
function resetPreview(){
    var element = document.getElementById("preview");
    while(element.firstChild){
        element.removeChild(element.firstChild);
    }
    // document.getElementById("select-img").innerHTML = "選択";
    var hidden = document.getElementById("hidden");
    hidden.value ="";
}

//文字数カウント
document.addEventListener('DOMContentLoaded', function() {
    const textArea = document.querySelector('#textarea'); // テキストエリアの要素
    const length = document.querySelector('.length'); // 残り文字数を表示させる要素
    const maxLength = 100 // 最大文字数
    length.textContent = maxLength - textArea.value.length;
    if(maxLength - textArea.value.length < 0){
        length.style.color = 'red'; // 最大文字数を超過したら赤字で表示する
    }else{
        length.style.color = '#444';
    }
    textArea.addEventListener('input', () => {
        length.textContent = maxLength - textArea.value.length;
        if(maxLength - textArea.value.length < 0){
            length.style.color = 'red'; // 最大文字数を超過したら赤字で表示する
        }else{
            length.style.color = '#444';
        }
    }, false);
}, false);

// // 画面読み込み時文字数カウント
// function firstscript(){
//     length.textContent = maxLength - textArea.value.length;
//     // alert('読み込み成功')
// }
// window.onload = firstscript;