//文字数カウント　タイトル(100)
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

//文字数カウント　内容(5000)
const textArea2 = document.querySelector('#textarea2'); // テキストエリアの要素
const length2 = document.querySelector('.length2'); // 残り文字数を表示させる要素
const maxLength2 = 5000 // 最大文字数
textArea2.addEventListener('input', () => {
    length2.textContent = maxLength2 - textArea2.value.length;
    if(maxLength2 - textArea2.value.length < 0){
    length2.style.color = 'red'; // 最大文字数を超過したら赤字で表示する
    }else{
    length2.style.color = '#444';
    }
}, false);