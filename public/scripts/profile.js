let form = document.getElementById("form");
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
//
// if(editBtn && hideEl && activeEl){
//     editBtn.onclick = function() {
//         hideEl.style.display = "block";
//         activeEl.style.display = "none";
//     };
// }

// let editBtn = document.getElementById("edit");
// let saveBtn = document.getElementById("save");
// let editName = document.getElementById("editName");
// let currentName = document.getElementById("currentName");
//

const getFormData = function(form) {
    let res = {};

    for (let i = 0; i < form.length; i++) {
        let el = form[i];
        if (el.name !== 'submit') {
            res[el.name] = el.value;
        }
    }

    return res;
};

let response = null;


function showLoader() {
    let loader = document.getElementById('loader');
    document.getElementById('save').disabled = true;
    loader.style.display = "block";
}

function hideLoader() {
    let loader = document.getElementById('loader');
    document.getElementById('save').disabled = false;
    loader.style.display = "none";
}

onResponse = function(request) {
    response = request.response;
    hideLoader();
    console.log('RESPONSE:', response);
};


form.addEventListener('submit', function(event) {
    event.preventDefault();
    let data = new getFormData(form);
    let req = new Requests();

    let str_data = '';


    showLoader();

    req.post('/camagru_mvc/api/profile/edit', onResponse, str_data, data);

});

//
//
//
// saveBtn.addEventListener('click', function() {
//     // hide the button
//     console.log('save');
//     this.style.display = 'none';
//     editBtn.style.display = 'block';
//     editName.style.display = 'none';
//     currentName.style.display = 'block';
//     // hideEl.style.display = "block";
//     // activeEl.style.display = "none";
//     // send the request
// });