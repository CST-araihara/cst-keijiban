//文字数カウント　タイトル(100)
document.addEventListener('DOMContentLoaded',function(){
    const title = document.querySelector('#title'); // テキストエリアの要素
    const title_length = document.querySelector('.title_length'); // 残り文字数を表示させる要素
    const title_maxlength = 100 // 最大文字数
    title_length.textContent = title_maxlength - title.value.length;//読み込まれたときの文字数を表示
    if(title_maxlength - title.value.length < 0){
        title_length.style.color = 'red'; // 最大文字数を超過したら赤字で表示する
    }else{
        title_length.style.color = '#444';
    }
    title.addEventListener('input', () => {
        title_length.textContent = title_maxlength - title.value.length;
        if(title_maxlength - title.value.length < 0){
            title_length.style.color = 'red'; // 最大文字数を超過したら赤字で表示する
        }else{
            title_length.style.color = '#444';
        }
    }, false);
},false);

//文字数カウント　内容(5000)
document.addEventListener('DOMContentLoaded',function(){
    const contents = document.querySelector('#contents'); // テキストエリアの要素
    const contents_length = document.querySelector('.contents_length'); // 残り文字数を表示させる要素
    const contents_maxlength = 5000 // 最大文字数
    contents_length.textContent = contents_maxlength - contents.value.length;
    if(contents_maxlength - contents.value.length < 0){
    contents_length.style.color = 'red'; // 最大文字数を超過したら赤字で表示する
    }else{
    contents_length.style.color = '#444';
    }
    contents.addEventListener('input', () => {
        contents_length.textContent = contents_maxlength - contents.value.length;
        if(contents_maxlength - contents.value.length < 0){
        contents_length.style.color = 'red'; // 最大文字数を超過したら赤字で表示する
        }else{
        contents_length.style.color = '#444';
        }
    }, false);
},false);

// 写真・動画プレビュー
$(document).ready(function () {
    var view_box = $('.view_box');
    
    $(".file").on('change', function(){
        var fileprop = $(this).prop('files')[0],
            // find_img = $(this).next('img'),
            find_img = $(".view_box").parent().find('.preview_img')
            fileRdr = new FileReader();

        if(fileprop.name != null){
        
            if(find_img.length != 0){
                find_img.nextAll().remove();
                find_img.remove();
            }
        
            // var img = '<img height="100" alt="" class="img_view"><a href="#" class="img_del">リセット</a>';
            var img = '<div class="preview_img"><img height="100" alt="" class="img_view"><input class="img_del" type="reset" value="Reset"></div>';
        
            view_box.append(img);

            console.log(fileprop);
            let file_name = fileprop.name;
            let file_type = file_name.split('.').pop();
            
            if(file_type == 'mp4'){
                fileRdr.onload = function() {
                    var blob = new Blob([fileRdr.result], {type: fileprop.type});
                    var url = URL.createObjectURL(blob);
                    var video = document.createElement('video');
            
                    var thumbnailFrame = 0; // サムネイル取得秒指定
                    var retryCount = 10; // サムネイル生成失敗許容回数
                    var currentCount = 0;
            
                    // timeupdateイベントで動画の再生を検知しています
                    var timeupdate = function() {
                        if (snapImage()) {
                            video.removeEventListener('timeupdate', timeupdate);
                            video.pause();
                        }
                        else if (currentCount == retryCount) {
                        // サムネイル生成失敗
                            console.log("make thumbnail failed");
                            video.removeEventListener('timeupdate', timeupdate);
                            video.pause();
                        }
                    }
            
                    video.addEventListener('canplay', function() {
                        if (video.duration > thumbnailFrame) {
                            video.currentTime = thumbnailFrame; 
                        }
                        else {
                            video.currentTime = video.duration / 2;
                        }
                    });
                    var snapImage = function() {
                        // 3.再生後、さらに新規生成した<canvas>要素で描画
                        var canvas = document.createElement('canvas');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
                        // 4.描画後にtoDataURL()関数を利用して画像blobを取得、適宜<img>要素へ適応
                        var image = canvas.toDataURL("image/png");
                        // var success = image.length > 100000;
                        var success = image.length > 10000;
                        if (success) {
                            // var img = $(".thumbnail");
                            // img.attr('src', image);
                            view_box.find('img').attr('src', image);
                            img_del(view_box); 
                            setTimeout(() => { // Safari対策
                                URL.revokeObjectURL(url);
                            }, 2000);
                        }
                        else {
                            currentCount+=1;
                        }
                        return success;
                    }
                    // 2.選択された動画を新規生成した<video>要素で再生
                    video.addEventListener('timeupdate', timeupdate);
                    video.preload = 'meta';
                    video.src = url;
                    // Safari / IE11
                    video.muted = true;
                    video.playsInline = true;
                    video.currentTime = thumbnailFrame;
                    video.play();
                }
                fileRdr.readAsArrayBuffer(fileprop);
            
            }else{
                fileRdr.onload = function() {
                    view_box.find('img').attr('src', fileRdr.result);
                    img_del(view_box); 
                }
                fileRdr.readAsDataURL(fileprop);
            }
            // console.log(find_img);
        }
    });
    
    function img_del(target){
        target.find("input.img_del").on('click',function(){

            $('div.preview_img').parent().find('input[type=file]').val('');
            $(this).parent().find('.img_view, br').remove();
            $(this).remove();

            return false;
        });
    }
});

// //ファイル選択フォームの更新イベントに処理を追加
// document.getElementById("filesend").addEventListener('change',function(e){
//     var files = e.target.files;
//     previewUserFiles(files);
// });

// 選択画像をプレビュー
// function previewUserFiles(files){
//     resetPreview();

//     for(var i=0; i<files.length; i++){
//         var file = files[i];
//         if(file.type.indexOf("image")<0){
//             continue;
//         }
//         var img = document.createElement("img");
//         img.classList.add("previewImage");
//         img.file = file;
//         img.height = 100;
//         document.getElementById('previewbox').appendChild(img);
//         var reader = new FileReader();
//         reader.onload = (function(tImg){return function(e){tImg.src = e.target.result;};})(img);
//         reader.readAsDataURL(file);
//     }
// }
