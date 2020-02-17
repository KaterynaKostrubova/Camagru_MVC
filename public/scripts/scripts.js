
function addActiveClass(e) {
    let elems = document.querySelector(".active");
    if(elems !== null){
        elems.classList.remove("active");
    }
    e.target.className = "active";
}

let registerBtn = document.getElementById("register");
let loginBtn = document.getElementById("login");
let signUp = document.getElementById("sign_up");
let logIn = document.getElementById("log_in");


let galleryBlock = document.getElementById("user_gallery");
let settingsBlock = document.getElementById("user_settings");
let galBtn = document.getElementById("gal");
let setBtn = document.getElementById("sett");

if(galBtn){
    galBtn.onclick = function () {
        galleryBlock.style.display = "block";
        settingsBlock.style.display = "none";
    }
}

if(setBtn){
    setBtn.onclick = function () {
        galleryBlock.style.display = "none";
        settingsBlock.style.display = "block";
    }
}


// function checkLogin(){
//     let signUp = document.getElementById("sign_up");
//     let logIn = document.getElementById("log_in");
//     let action = location.search.split('=')[1];
//     if (action == 'login'){
//         signUp.style.display = "none";
//         logIn.style.display = "block";
//         let elems = document.querySelector(".active");
//         let elems2 = document.getElementById("login");
//         if(elems !== null && elems2 !== null){
//             elems.classList.remove("active");
//             elems2.classList.add("active");
//         }
//     }
// }

//
// let submitBtn = document.getElementById("sbm");

if(registerBtn && logIn && signUp){
    registerBtn.onclick = function() {
        logIn.style.display = "none";
        signUp.style.display = "block";
    };
}

if(loginBtn && logIn && signUp) {
    loginBtn.onclick = function () {
        signUp.style.display = "none";
        logIn.style.display = "block";
    };
}




//
// submitBtn.onclick = function () {
//     signUp.style.display = "none";
//     logIn.style.display = "block";
// };



// function modalWindow() {
//     // Get the modal
//     let modal = document.getElementById("myModal");
//
// // Get the button that opens the modal
//     let btn = document.getElementById("sbm");
//
// // Get the <span> element that closes the modal
//     let span = document.getElementsByClassName("close")[0];
//
// // When the user clicks the button, open the modal
//     btn.onclick = function() {
//         modal.style.display = "block";
//     }
//
// // When the user clicks on <span> (x), close the modal
//     span.onclick = function() {
//         modal.style.display = "none";
//     }
//
// // When the user clicks anywhere outside of the modal, close it
//     window.onclick = function(event) {
//         if (event.target == modal) {
//             modal.style.display = "none";
//         }
//     }
// }


//pagination

// let list = new Array();
// let pageList = new Array();
// let currentPage = 1;
// let numberPerPage = 10;
// let numberOfPages = 0;
//
// function makeList() {
//     for (x = 0; x < 200; x++)
//         list.push(x);
//
//     numberOfPages = getNumberOfPages();
// }
//
// function getNumberOfPages() {
//     return Math.ceil(list.length / numberPerPage);
// }
//
// function nextPage() {
//     currentPage += 1;
//     loadList();
// }
//
// function previousPage() {
//     currentPage -= 1;
//     loadList();
// }
//
// function firstPage() {
//     currentPage = 1;
//     loadList();
// }
//
// function lastPage() {
//     currentPage = numberOfPages;
//     loadList();
// }
//
// function loadList() {
//     let begin = ((currentPage - 1) * numberPerPage);
//     let end = begin + numberPerPage;
//
//     pageList = list.slice(begin, end);
//     drawList();
//     check();
// }
//
// function drawList() {
//     document.getElementById("list").innerHTML = "";
//     for (r = 0; r < pageList.length; r++) {
//         document.getElementById("list").innerHTML += pageList[r] + "<br/>";
//     }
// }
//
// function check() {
//     document.getElementById("next").disabled = currentPage == numberOfPages ? true : false;
//     document.getElementById("previous").disabled = currentPage == 1 ? true : false;
//     document.getElementById("first").disabled = currentPage == 1 ? true : false;
//     document.getElementById("last").disabled = currentPage == numberOfPages ? true : false;
// }
//
// function load() {
//     makeList();
//     loadList();
// }
//
// window.onload = load;
