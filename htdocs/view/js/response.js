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