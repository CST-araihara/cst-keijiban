//文字数カウント
const textArea = document.querySelector('#textarea'); // テキストエリアの要素
const length = document.querySelector('.length'); // 残り文字数を表示させる要素
const maxLength = 5000 // 最大文字数
textArea.addEventListener('input', () => {
    length.textContent = maxLength - textArea.value.length;
    if(maxLength - textArea.value.length < 0){
        length.style.color = 'red'; // 最大文字数を超過したら赤字で表示する
    }else{
        length.style.color = '#444';
    }
}, false);

// 画像表示
function imgPreview(event) {
    var file = event.target.files[0];
    var reader = new FileReader();
    var preview = document.getElementById('preview');
    var previewImage = document.getElementById('previewImage');
    var reset = document.getElementById('reset');

    if (previewImage != null) {
        preview.removeChild(previewImage);
        preview.removeChild(reset);
    }
    else if (preview != null) {
        preview.innerHTML ="";
    }

    reader.onload = function(event) {

        if (file.name.match(/.mp4/)) {
            var video = document.createElement('video');
            video.setAttribute('src',reader.result);
            video.setAttribute('height','100%');
            video.setAttribute('controls', '');
            preview.appendChild(video);
        }
        else {
            var img = document.createElement('img');
            img.setAttribute('src',reader.result);
            img.setAttribute('id','previewImage');
            preview.appendChild(img);
        }

        var reset = document.createElement('input');
        reset.setAttribute('type','button');
        reset.setAttribute('value','Reset');
        reset.setAttribute('class','img-reset__btn');
        reset.setAttribute('onclick','resetPreview()');
        reset.setAttribute('id','reset');
        preview.appendChild(reset);
    };

    reader.readAsDataURL(file);
}

// 画像リセットボタン
function resetPreview(){
    var element = document.getElementById("preview");
    while(element.firstChild){
        element.removeChild(element.firstChild);
    }
    // document.getElementById("select-img").innerHTML = "選択";
    // var hidden = document.getElementById("hidden");
    // hidden.value ="";
}