// function myFunction(e) {
//     let elems = document.querySelector(".active");
//     if(elems !== null){
//         elems.classList.remove("active");
//     }
//     e.target.className = "active";
// }
//
// let registerBtn = document.getElementById("register");
// let loginBtn = document.getElementById("login");
//
// let signUp = document.getElementById("sign_up");
// let logIn = document.getElementById("log_in");
//
// let submitBtn = document.getElementById("sbm");
//
// registerBtn.onclick = function() {
//     logIn.style.display = "none";
//     signUp.style.display = "block";
// };
//
// loginBtn.onclick = function() {
//     signUp.style.display = "none";
//     logIn.style.display = "block";
// };
//
// submitBtn.onclick = function () {
//     signUp.style.display = "none";
//     logIn.style.display = "block";
// };



function modalWindow() {
    // Get the modal
    var modal = document.getElementById("myModal");

// Get the button that opens the modal
    var btn = document.getElementById("sbm");

// Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

// When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

// When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}
