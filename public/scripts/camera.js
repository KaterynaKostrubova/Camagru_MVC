
let filter = null;
let streaming = false;

let videoClass = document.querySelector('.video');
let constraints = {};

// let canvas = document.querySelector('#photo_canvas');
// let filterCanvas = document.querySelector('#filter_canvas');
// let filterCtx = filterCanvas.getContext('2d');

let uploadfile = document.querySelector('#fileupload');

let saveBtn = document.querySelector('#save_btn');
let reset_btn = document.querySelector('#reset_btn');
let takePhoto = document.querySelector('#stopbt');
let filter_container = document.querySelector('#filter_container');
let classInactive = document.querySelectorAll('.inactive_click');

let newImg = null;

let canvasData   = null;
let filterData = null;
let width = 720;
let height = 480;
let stikerWidth = 200;
let stikerHeight = 200;

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

let widthWin = document.documentElement.clientWidth;

if (widthWin <= 720 && widthWin >= 480){
    width = 480;
    height = 320;
    stikerWidth = 100;
    stikerHeight = 100;
} else if (widthWin < 480){
    width = 320;
    height = 256;
    stikerWidth = 50;
    stikerHeight = 50;
}

let video = document.querySelector('#video');

if (navigator.getUserMedia) {
    navigator.getUserMedia({
            video: true,
            audio: false
        },
        function(stream) {
            video.srcObject = stream;
            video.onloadedmetadata = function(e) {
                video.play();
            };
        },
        function(err) {
            console.log("The following error occurred: " + err.name);
        }
    );
} else {
    console.log("getUserMedia not supported");
}

let canvas = document.querySelector('#photo_canvas');
let filterCanvas = document.querySelector('#filter_canvas');
let filterCtx = filterCanvas.getContext('2d');

video.addEventListener('canplay', function(e){
    if (!streaming) {
        height = video.videoHeight / (video.videoWidth/width);
        video.setAttribute('width', width);
        video.setAttribute('height', height);
        canvas.setAttribute('width', width);
        canvas.setAttribute('height', height);
        filterCanvas.setAttribute('width', width);
        filterCanvas.setAttribute('height', height);
        streaming = true;
    }
}, false);

// let filterX = width / 2 - stikerWidth / 2;
// let filterY = height / 2 - stikerHeight / 2;
let filterX = 0;
let filterY = 0;

filter_container.addEventListener('click',  function(e){
    if (e.target.id !== "filter_container")
    {
        if (filter != null){
            filter.classList.remove('selected_stick');
        }
        if (e.target === filter){
            filter = null;
            filterCtx.clearRect(0, 0, width, height);
        } else {
            e.target.classList.add('selected_stick');
            filter = e.target;
            newImg = new Image();
            newImg.src = filter.src;
            if (filter)
            {
                filterCtx.clearRect(0, 0, width, height);
                filterCtx.drawImage(newImg, filterX, filterY, stikerWidth, stikerHeight);
                takePhoto.removeAttribute('disabled');
                classInactive[0].classList.add('active_click');
            }
        }
    }
});

filterCanvas.onmousedown = function(event) {

    moveAt(event.clientX, event.clientY);

    function moveAt(pageX, pageY) {
        let x = pageX - ((document.body.offsetWidth - filterCanvas.offsetWidth) / 2) - stikerWidth / 2;
        let y = pageY - (filterCanvas.getBoundingClientRect().top) - stikerHeight / 2;
        filterCtx.clearRect(0, 0, width, height);
        filterCtx.drawImage(newImg, x, y, stikerWidth, stikerHeight);
    }

    function onMouseMove(event) {
        moveAt(event.clientX, event.clientY);
    }

    filterCanvas.addEventListener('mousemove', onMouseMove);

    document.body.onmouseup = function() {
        filterCanvas.removeEventListener('mousemove', onMouseMove);
        document.body.onmouseup = null;
    };
};

filterCanvas.ondragstart = function() {
    return false;
};


function addImage(response){
    let edited_block = document.getElementById("edited_photos");
    // console.log(response);
    let json_data = JSON.parse(response);

    let div = document.createElement("div");

    div.className = "img_card img_card_" + json_data['id'];
    edited_block.prepend(div);

    let img = document.createElement("img");
    img.id = "edited_" + json_data['id'];
    img.className = "edited";
    img.src = json_data['photo'];
    div.prepend(img);

    let del = document.createElement("input");
    del.className = 'delete';
    del.id = "delete_" + json_data['id'];
    del.type = "button";
    del.onclick = deletePhoto;
    div.append(del);
}


uploadfile.addEventListener('change', function(e){
    canvas.width = width;
    canvas.height = height;
    let img = new Image;
    img.src = URL.createObjectURL(e.target.files[0]);
    img.onload = function() {
        canvas.getContext('2d').drawImage(img, 0, 0, width, height);
        canvasData = canvas.toDataURL("image/png");
    }
});

takePhoto.addEventListener(
    'click',
    function(e){
        canvas.width = width;
        canvas.height = height;
        canvas.getContext('2d').drawImage(video, 0, 0, width, height);
        canvasData = canvas.toDataURL("image/png");
        saveBtn.removeAttribute('disabled');
        classInactive[1].classList.add('active_click');
        e.preventDefault();
    }, false);

reset_btn.addEventListener('click', function(){
    filterCtx.clearRect(0, 0, width, height);
    filter = null;
    canvas.getContext('2d').clearRect(0, 0, width, height);
    canvasData = null;
    uploadfile.value = "";
    if(!takePhoto.hasAttribute('disabled')){
        takePhoto.setAttribute('disabled', 'true');
    }
    classInactive[0].classList.remove('active_click');
    classInactive[1].classList.remove('active_click');
    document.querySelector('.selected_stick').classList.remove('selected_stick');
}, false);



let saveResponse = function(request) {
    let response = request.response;
    addImage(response);
    reset_btn.click();
};

saveBtn.addEventListener('click', function(e){
        filterData = filterCanvas.toDataURL("image/png");
           let data_param = {
                "data" : canvasData,
                "filter" : filterData
            };

            let string_param = create_param(data_param);
            let req = new Requests();
            req.post('/camagru_mvc/api/save/photo', saveResponse, string_param);
        e.preventDefault();
}, false);



let delResponse = function(request) {
    let response = request.response;
    console.log(response);
    let del = document.querySelector('.img_card_' + response['id']);
    del.remove();
    if(response['path']){
        let ava = document.querySelector('.avatar_min');
        ava.src = response['path'];
    }
};

function  deletePhoto(e) {
    let req = new Requests();
    let id = e.target.id.split('_')[1] + '';
    console.log(id);
    let str ='';
    let data = {
        'id' : id,
    };
    req.post('/camagru_mvc/api/delete/photo', delResponse, str, data);
    e.preventDefault();
}

function create_param(param){
    let parameterString = "";
    let isFirst = true;
    for(let i in param) {
        if(!isFirst) {
            parameterString += "&";
        }
        parameterString += encodeURIComponent(i) + "=" + encodeURIComponent(param[i]);
        isFirst = false;
    }
    return (parameterString);
}



// var idx = 0;
// var filters = ['grayscale', 'sepia', 'blur', 'brightness', 'contrast', 'hue-rotate',
//     'hue-rotate2', 'hue-rotate3', 'saturate', 'invert', ''];
//
// function changeFilter(e) {
//     // var el = e.target;
//     var el = document.querySelector('#video');
//     el.className = '';
//     var effect = filters[idx++ % filters.length]; // loop through filters.
//     if (effect) {
//         el.classList.add(effect);
//     }
// }
//
// document.querySelector('#stiker_container #stiker_0').addEventListener('click', changeFilter, false);