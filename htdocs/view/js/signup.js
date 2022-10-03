// パスワードを表示する
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

// パスワードマスクre
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
function previewFile(file) {
    // プレビュー画像を追加する要素
    const preview = document.getElementById('preview');

    // FileReaderオブジェクトを作成
    const reader = new FileReader();

    // ファイルが読み込まれたときに実行する
    reader.onload = function (e) {
        const imageUrl = e.target.result; // 画像のURLはevent.target.resultで呼び出せる
        const img = document.createElement("img"); // img要素を作成
        img.src = imageUrl; // 画像のURLをimg要素にセット
        preview.appendChild(img); // #previewの中に追加
    }
    // いざファイルを読み込む
    reader.readAsDataURL(file);
}
    // <input>でファイルが選択されたときの処理
const fileInput = document.getElementById('icon-img');
const handleFileSelect = () => {
    const files = fileInput.files;
    for (let i = 0; i < files.length; i++) {
        previewFile(files[i]);
    }
}
fileInput.addEventListener('change', handleFileSelect);

// 画像リセットボタン
function resetPreview(){
    var element = document.getElementById("preview");
    while(element.firstChild){
        element.removeChild(element.firstChild);
    }
    // document.getElementById("select-img").innerHTML = "選択";
}

//文字数カウント
const textArea = document.querySelector('#textarea'); // テキストエリアの要素
const length = document.querySelector('.length'); // 残り文字数を表示させる要素
const maxLength = 100 // 最大文字数
textArea.addEventListener('input', () => {
    length.textContent = maxLength - textArea.value.length;
    if(maxLength - textArea.value.length < 0){
        length.style.color = 'red'; // 最大文字数を超過したら赤字で表示する
    }else{
        length.style.color = '#444';
    }
}, false);