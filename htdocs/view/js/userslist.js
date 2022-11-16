window.addEventListener('load', function () {
    let column_no = 0; //今回クリックされた列番号
    let column_no_prev = 0; //前回クリックされた列番号

    document.querySelectorAll('#filter th').forEach(elm => {
        elm.onclick = function () {
            column_no = this.cellIndex; //クリックされた列番号
            let table = this.parentNode.parentNode.parentNode;
            let sortType = 0; //0:数値 1:文字
            let sortArray = new Array; //クリックした列のデータを全て格納する配列
            let element = event.target;
            for (let r = 1; r < table.rows.length; r++) {
                //行番号と値を配列に格納
                let column = new Object;
                column.row = table.rows[r];
                column.value = table.rows[r].cells[column_no].textContent;
                sortArray.push(column);

                // 名前と詳細はソートしない
                if (column_no == 3 || column_no == 4 || column_no == 6) {
                    return;
                }

                //数値判定
                if (isNaN(Number(column.value))) {
                    sortType = 1; //値が数値変換できなかった場合は文字列ソート
                }
            }
            if (sortType == 0) { //数値ソート
                if (column_no_prev == column_no) { //同じ列が2回クリックされた場合は降順ソート
                    sortArray.sort(compareNumberDesc);
                } else {
                    sortArray.sort(compareNumber);
                }
            } else { //文字列ソート
                if (column_no_prev == column_no) { //同じ列が2回クリックされた場合は降順ソート
                    sortArray.sort(compareStringDesc);
                } else {
                    sortArray.sort(compareString);
                }
            }

            if (element.classList.contains('asc')) {
                element.classList.replace('asc', 'desc');
            }
            else if (element.classList.contains('desc')) {
                element.classList.replace('desc', 'asc');
            }
            else {
                element.classList.add('asc');
            }
            
            Array.from(element.parentNode.children)
            .filter(e => e !== element)
            .forEach(e => e.classList.remove('asc', 'desc'));
            
            //ソート後のtrオブジェクトを順番にtbodyへ追加（移動）
            let tbody = this.parentNode.parentNode.parentNode;
            for (let i = 0; i < sortArray.length; i++) {
                tbody.appendChild(sortArray[i].row);
            }
            //昇順／降順ソート切り替えのために列番号を保存
            if (column_no_prev == column_no) {
                column_no_prev = -1; //降順ソート
            } else {
                column_no_prev = column_no;
            }
        };
    });
});

//数値ソート（昇順）
function compareNumber(a, b)
{
    return a.value - b.value;
}
//数値ソート（降順）
function compareNumberDesc(a, b)
{
    return b.value - a.value;
}
//文字列ソート（昇順）
function compareString(a, b) {
    if (a.value < b.value) {
        return -1;
    } else {
        return 1;
    }
    return 0;
}
//文字列ソート（降順）
function compareStringDesc(a, b) {
    if (a.value > b.value) {
        return -1;
    } else {
        return 1;
    }
    return 0;
}

// 検索
let id = document.getElementById('id');
let login_id = document.getElementById('login_id');
let handlename = document.getElementById('handlename');
let l_name = document.getElementById('l_name');
let f_name = document.getElementById('f_name');
let not_delete = document.getElementById('not_delete');
let deleted = document.getElementById('deleted');
let submit = document.getElementById('submit');

let userslist = document.getElementsByName('userslist');

const ID = 0;
const LOGIN_ID = 1;
const HANDLENAME = 2;
const LAST_NAME = 3;
const FIRST_NAME = 4;
const NOT_DELETE = 7;
const DELETED = 8;

submit.addEventListener('click', function () {
    userslist.forEach(function(elem) {
        elem.style.display = "table-row";

        if (not_delete.checked == true && elem.cells[NOT_DELETE].innerHTML.indexOf('削除') == -1) {
            elem.style.display = "none";
        }

        if (deleted.checked == true && elem.cells[DELETED].innerHTML.indexOf('復元') == -1) {
            elem.style.display = "none";
        }

        if (not_delete.checked == true && deleted.checked == true) {
            elem.style.display = "table-row";
        }

        if (id.value !="" && elem.cells[ID].innerHTML.indexOf(id.value) == -1) {
            elem.style.display = "none";
        }

        if (login_id.value !="" && elem.cells[LOGIN_ID].innerHTML.indexOf(login_id.value) == -1) {
            elem.style.display = "none";
        }

        if (handlename.value !="" && elem.cells[HANDLENAME].innerHTML.indexOf(handlename.value) == -1) {
            elem.style.display = "none";
        }

        if (l_name.value !="" && elem.cells[LAST_NAME].innerHTML.indexOf(l_name.value) == -1) {
            elem.style.display = "none";
        }

        if (f_name.value !="" && elem.cells[FIRST_NAME].innerHTML.indexOf(f_name.value) == -1) {
            elem.style.display = "none";
        }
    })

});