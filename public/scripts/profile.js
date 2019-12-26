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
    let check = document.getElementById('sendToEmail');
    let res = {};


    for (let i = 0; i < form.length; i++) {
        let el = form[i];
        if (el.name === "notification"){
            res[el.name] = el.checked;
        }
        else if (el.name !== 'submit') {
            res[el.name] = el.value;
        }
    }
    // console.log(res);
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

function popUp(response) {
    console.log(response);
    if(response == null)
        console.log('data already update!');
    else {
        // if(response['name'] === 'no' && response['email'] === 'no'  && response['notification'] === 'no'){
        //     // let popup = document.getElementById("myPopup");
        //     // popup.classList.toggle("show");
        //     console.log('data already update');
        // } else {
            console.log('data successfully update');
        // }
    }

}


// todo change console.log
onResponse = function(request) {
    let req = new Requests();
    response = request.response;
    console.log(response);
    hideLoader();
    popUp(response);
};


form.addEventListener('submit', function(event) {
    event.preventDefault();
    let data = new getFormData(form);
    console.log(data);
    let req = new Requests();

    let str_data = '';
    showLoader();
    // console.log('RESPONSE:', data);
    req.post('/camagru_mvc/api/profile/edit', onResponse, str_data, data);
    // console.log(str_data, '-', data);

});
