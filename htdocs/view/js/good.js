// let change_star = document.getElementById('change-star');
let star = document.getElementById('star');
let flg = false;
let flg2 = false;

document.addEventListener('DOMContentLoaded', function() {
    function changeColor () {
        if (flg == true) {
            star.animate({
                color:["gold","black"],
                fontWeight:["900","400"],
                },
                {
                    fill:"forwards",
                }
            );
        }
        else {
            if (flg2 == true) {
                star.animate({
                    color:["white","gold"],
                    fontWeight:["400","900"],
                    transform: "rotateX(0deg)"
                },
                {
                    fill:"forwards",
                    duration: 500
                });
            }
            else {
                star.animate({
                    color:["white","gold"],
                    fontWeight:["400","900"],
                    transform: "rotateX(360deg)"
                },
                {
                    fill:"forwards",
                    duration: 500
                });
            }
            flg2 = !flg2;
        }
        flg = !flg;
    }

    let fa_star = document.getElementsByClassName('contents__good');

    for(let i = 0; i < fa_star.length; i++) {
        fa_star[i].addEventListener('click', changeColor, false);
    }
    
},false)

// function changeColor () {

//     if (flg == true) {
//         star.animate({
//             color:["gold","black"],
//             fontWeight:["900","400"],
//             },
//             {
//                 fill:"forwards",
//             }
//         );
//     }
//     else {
//         if (flg2 == true) {
//             star.animate({
//                 color:["white","gold"],
//                 fontWeight:["400","900"],
//                 transform: "rotateX(0deg)"
//                 },
//                 {
//                     fill:"forwards",
//                     duration: 500
//                 }
//             );
//         }
//         else {
//             star.animate({
//                 color:["white","gold"],
//                 fontWeight:["400","900"],
//                 transform: "rotateX(360deg)"
//                 },
//                 {
//                     fill:"forwards",
//                     duration: 500
//                 }
//             );
//         }
//         flg2 = !flg2;
//     }
//     flg = !flg;
// }

// change_star.onclick = changeColor;