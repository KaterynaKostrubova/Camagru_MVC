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
    let response = request.response;
    // console.log(response);
    hideLoader();
    popUp(response);
};


form.addEventListener('submit', function(event) {
    event.preventDefault();
    let data = new getFormData(form);
    // console.log(data);
    let req = new Requests();
    let str_data = '';
    showLoader();
    // console.log('RESPONSE:', data);
    req.post('/camagru_mvc/api/profile/edit', onResponse, str_data, data);
    console.log(str_data, '-', data);

});


let changeResponse = function(request) {
    let response = request.response;
    // console.log(response);
    let ava = document.querySelector('.avatar');
    ava.src = response['path'];
};

function  changeAvatar(e) {
    let req = new Requests();
    let el = e.target.id.split('_');
    let str ='';
    if (el[1]){
        let photo_id = el[1] + '';
        let id = el[2] + '';
        let data = {
            'id' : id,
            'photo_id': photo_id,
        };
        req.post('/camagru_mvc/api/change/avatar', changeResponse, str, data);
    } else {
        let data = {
            'id': '0',
            'photo_id': '1',
        };
        req.post('/camagru_mvc/api/change/avatar', changeResponse, str, data);
    }

    e.preventDefault();
}

let changeBgResponse = function(request) {
    let response = request.response;
    console.log(response);
    let bg = document.querySelector('.photo-acc');
    bg.style.backgroundImage = 'url(' + response['path'] + ')';
};

function  changeBg(e) {
    let req = new Requests();
    let el = e.target.id.split('_');
    let str = '';
    if (el[1]) {
        let bg_id = el[1] + '';
        let id = el[2] + '';
        let data = {
            'id': id,
            'bg_id': bg_id,
        };
        req.post('/camagru_mvc/api/change/bg', changeBgResponse, str, data);
    } else {
        let data = {
            'id': '0',
            'bg_id': '3',
        };
        console.log(data);
        req.post('/camagru_mvc/api/change/bg', changeBgResponse, str, data);
    }
    e.preventDefault();
}

let send = document.getElementById('sendToEmail');

let checkResponse = function(request){
    let response = request.response;
    console.log(response);
    if(response['ntf'] === false)
        send.checked = false;
    else
        send.checked = true;
};


send.addEventListener('click', function (e) {
    let req = new Requests();
    let str ='';
    let data = {
        'ntf' : send.checked,
    };
    req.post('/camagru_mvc/api/notification', checkResponse, str, data);
    e.preventDefault();
});


