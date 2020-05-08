let _dirname = document.location.pathname.split('/')[1];
let form = document.getElementById("form");
let response = null;


//Edit profile data
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
    return res;
};

onResponse = function(request) {
    let response = request.response;
    let flag = 0;
    for(key in response){
        if(response[key] !== ''){
            showPopUp('Data  successfully update');
            flag = 1;
            break ;
        }
    }
    if(flag === 0)
        showPopUp('No data for update');
};


form.addEventListener('submit', function(event) {
    event.preventDefault();
    let data = new getFormData(form);
    if(data.newPass && data.newPassConfirm && !data.oldPass)
        showPopUp('Please, type current password!');
    else if(!data.newPass && !data.newPassConfirm && data.oldPass)
        showPopUp('If you want change password, type new password and confirm password, please! \n Otherwise, don\'t type current password!');
    else if (data.newPass !== data.newPassConfirm)
        showPopUp('Сonfirmation password is different! Try again!');
    else if(data.oldPass !== '' && data.newPass === data.oldPass)
        showPopUp('Current password = New password! Please, type new password!');
    else {
        let req = new Requests();
        let str_data = '';
        req.post('/' + _dirname + '/api/profile/edit', onResponse, str_data, data);
    }
});

//Pop Up
let popUpText = document.getElementById('myPopupText');
let popUp = document.getElementById('popup');
let close = document.getElementById('closePopUp');
let popup = document.getElementById("myPopup");

function showPopUp($text) {
    popUpText.innerText = $text;
    document.getElementById('save').disabled = true;
    popUp.style.display = 'block';
    popup.classList.add("show");
}

close.addEventListener('click',  function () {
    popup.classList.remove('show');
    document.getElementById('save').disabled = false;
    popUp.style.display = 'none';
});

popUp.addEventListener('click', function (e) {
    popup.classList.remove('show');
    document.getElementById('save').disabled = false;
    popUp.style.display = 'none';
});


//Change Avatar
let changeResponse = function(request) {
    let response = request.response;
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
        req.post('/' + _dirname + '/api/change/avatar', changeResponse, str, data);
    } else {
        let data = {
            'id': '0',
            'photo_id': '1',
        };
        req.post('/' + _dirname + '/api/change/avatar', changeResponse, str, data);
    }

    e.preventDefault();
}

//Change Background
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
        req.post('/' + _dirname + '/api/change/bg', changeBgResponse, str, data);
    } else {
        let data = {
            'id': '0',
            'bg_id': '3',
        };
        console.log(data);
        req.post('/' + _dirname + '/api/change/bg', changeBgResponse, str, data);
    }
    e.preventDefault();
}

//Pagination
let count = 0;
let perPage = 3;
let photo_block = document.getElementById("photo_block");
let prev = document.getElementById('prev');
let next = document.getElementById('next');
let numberPage = document.getElementById('num-page');
let first = document.getElementById('first');
let last = document.getElementById('last');

let simplePagination = function(request) {
    let response = request.response;
    if(response['action'] === 'last')
        count = response['numPage'];
    numberPage.innerText = response['numPage'] + 1;
    if(response['perPage'] * (response['numPage'] + 1) >= response['numberPhotos']){
        next.setAttribute('disabled', 'true');
        last.setAttribute('disabled', 'true');
        next.style.opacity = "0.5";
        last.style.opacity = "0.5";
    } else {
        next.removeAttribute('disabled');
        last.removeAttribute('disabled');
        next.style.opacity = "1";
        last.style.opacity = "1";
    }
    if (response['numPage'] === 0){
        prev.setAttribute('disabled', 'true');
        first.setAttribute('disabled', 'true');
        prev.style.opacity = "0.5";
        first.style.opacity = "0.5";
    } else {
        prev.removeAttribute('disabled');
        first.removeAttribute('disabled');
        prev.style.opacity = "1";
        first.style.opacity = "1";

    }
    if(response['photos'].length){
        let div = document.createElement('div');
        div.className = 'photo-wrap';
        for(let i = 0; i < response['photos'].length; i++) {
            div.innerHTML = div.innerHTML + '<div class="block"><img class="photo photo-' + response['photos'][i]['id'] + '" src="' +
                response['photos'][i]['path'] + '" alt="photo"><div class="btns"><input type="button" class="change_ava" id="change_' +
                response['photos'][i]['id'] + '_' + response['user_id'] +
                '" onclick="changeAvatar(event)" value="avatar"><input type="button" class="change_bg" id="changebg_' +
                response['photos'][i]['id'] + '_' + response['user_id'] +
                '" onclick="changeBg(event)" value="cover"></div></div></div>';
        }
        let removeBlock = document.querySelector('.photo-wrap');
        if(removeBlock){
            removeBlock.remove();
        }
        photo_block.append(div);
    }
};

window.onload = function (e){
    let data = {
        'counter': count,
        'perPage': perPage,
        'action': 'onload',
    };

    let req = new Requests();
    req.post('/' + _dirname +'/api/pagination', simplePagination, '', data);
};


next.addEventListener("click", function(e){
    count++;
    let data = {
        'counter': count,
        'perPage': perPage,
        'action': 'next',
    };

    let req = new Requests();
    req.post('/' + _dirname + '/api/pagination', simplePagination, '', data);
});

prev.addEventListener("click", function(e){
    if(count > 0){
        count--;
        let data = {
            'counter': count,
            'perPage': perPage,
            'action': 'prev',
        };

        let req = new Requests();
        req.post('/' + _dirname +'/api/pagination', simplePagination, '', data);
    }
});

first.addEventListener("click", function(e){
        count = 0;
        let data = {
            'counter': count,
            'perPage': perPage,
            'action': 'first',
        };
        let req = new Requests();
        req.post('/' + _dirname + '/api/pagination', simplePagination, '', data);
});

last.addEventListener("click", function(e){
    let data = {
        'counter': -1,
        'perPage': perPage,
        'action': 'last',
    };
    let req = new Requests();
    req.post('/' + _dirname + '/api/pagination', simplePagination, '', data);
});


// let send = document.getElementById('sendToEmail');

// let checkResponse = function(request){
//     let response = request.response;
//     console.log(response);
//     if(response['ntf'] === false)
//         send.checked = false;
//     else
//         send.checked = true;
// };
//
//
// send.addEventListener('click', function (e) {
//     let req = new Requests();
//     let str ='';
//     let data = {
//         'ntf' : send.checked,
//     };
//     req.post('/' + _dirname + '/api/notification', checkResponse, str, data);
//     e.preventDefault();
// });
