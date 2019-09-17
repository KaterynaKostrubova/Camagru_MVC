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
// todo change console.log
onResponse = function(request) {
    response = request.response;
    hideLoader();
    if(response == null)
        console.log('data already update');
    else {
        if(response['name'] === 'no' && response['email'] === 'no')
            console.log('data already update');
        else if (response['name'] === 'no' && response['email'] === 'yes') {
            console.log('pls confirm email//email successfully update');
        }
        else if(response['name'] === 'yes' && response['email'] === 'no')
            console.log('name successfully update');
        else if (response['name'] === 'yes' && response['email'] === 'yes')
            console.log('data successfully update');
    }
};


form.addEventListener('submit', function(event) {
    event.preventDefault();
    let data = new getFormData(form);
    let req = new Requests();

    let str_data = '';
    showLoader();
    // console.log('RESPONSE:', data);
    req.post('/camagru_mvc/api/profile/edit', onResponse, str_data, data);
    // console.log(str_data, '-', data);

});
