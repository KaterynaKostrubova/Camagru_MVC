(function() {

    'use strict';

    // find the desired selectors
    let editBtn = document.getElementById("edit");
    let saveBtn = document.getElementById("save");
    let editName = document.getElementById("editName");
    let currentName = document.getElementById("currentName");

    // set up a request
    let request = new XMLHttpRequest();

    // keep track of the request
    request.onreadystatechange = function() {
        // check if the response data send back to us
        if(request.readyState === 4) {
            // uncomment the line below to see the request
            console.log(request);
            // check if the request is successful
            if(request.status === 200) {
                console.log(request.status);
                // update the HTML of the element
                // bio.innerHTML = request.responseText;
            } else {
                console.log('error');
                // otherwise display an error message
                // bio.innerHTML = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
            }
        }
    };

    // specify the type of request
    request.open('Post', '/camagru_mvc/profile/profile');

    // register an event
    editBtn.addEventListener('click', function() {
        console.log(request);
        // hide the button

        this.style.display = 'none';
        saveBtn.style.display = 'block';
        editName.style.display = 'block';
        currentName.style.display = 'none';
        // hideEl.style.display = "block";
        // activeEl.style.display = "none";
        // send the request
        request.send();
    });



    saveBtn.addEventListener('click', function() {
        console.log(request);
        // hide the button

        this.style.display = 'none';
        editBtn.style.display = 'block';
        editName.style.display = 'none';
        currentName.style.display = 'block';
        // hideEl.style.display = "block";
        // activeEl.style.display = "none";
        // send the request
        request.send();
    });

})();


// let editBtn = document.getElementById("edit");
// let hideEl = document.getElementsByClassName("hide");
// let activeEl = document.getElementsByClassName("active");
//
//
// // console.log(editBtn, hideEl, activeEl);
// editBtn.onclick = function(){
//     // alert("tut");
//     hideEl.style.display = "block";
//     // activeEl.style.display = "none";
//
// }

// if(editBtn && hideEl && activeEl){
//     editBtn.onclick = function() {
//         hideEl.style.display = "block";
//         activeEl.style.display = "none";
//     };