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

//文字数バリデーション
document.addEventListener('DOMContentLoaded',() => {
    //.validationForm を指定した最初の form 要素を取得
    const validationForm = document.querySelector('.validationForm');
    //maxlength クラスを指定された要素の集まり
    const maxlengthElems =  document.querySelectorAll('.maxlength');

    validationForm.addEventListener('submit',(e) => {
        maxlengthElems.forEach((elem) => {
            //data-maxlength 属性から最大文字数を取得
            const maxlength = elem.dataset.maxlength;
            if (elem.value !=='') {
                if (elem.value.length > maxlength) {
                    var error = document.getElementById('error');
                    error.style.visibility ='visible';
                    e.preventDefault();
                }
            }
        })
    })
})