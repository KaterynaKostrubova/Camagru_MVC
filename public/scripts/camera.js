
let sticker = null;

let streaming = false;
let uploadfile = document.querySelector('#fileupload');

let saveBtn = document.querySelector('#save_btn');
let reset_btn = document.querySelector('#reset_btn');
let takePhoto = document.querySelector('#stopbt');

let classInactive = document.querySelectorAll('.inactive_click');

let newImg = null;
let uploadImg = null;

let canvasData   = null;
let filterData = null;
let width = 720;
let height = 480;
let stikerWidth = 200;
let stikerHeight = 200;

let filtersName = {
    'grayscale' : 'grayscale(1)',
    'brightness' : 'grayscale(20%)',
    'sepia' : 'sepia(1)',
    'blur' : 'blur(3px)',
    'contrast' : 'contrast(120%)',
    'hue-rotate' : 'hue-rotate(180deg)',
    'invert' : 'invert(100%)',
    'opacity' : 'opacity(30%)',
    'saturate' : 'saturate(200%)',
};

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia;

let widthWin = document.documentElement.clientWidth;

if (widthWin <= 1024 && widthWin >= 480){
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
let canvasCtx = canvas.getContext('2d');
let filterCanvas = document.querySelector('#filter_canvas');
let filterCtx = filterCanvas.getContext('2d');

let sticker_container = document.querySelector('#sticker_container');
let filterX = 0;
let filterY = 0;
let filter = 'none';

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

sticker_container.addEventListener('click',  function(e){
    if (e.target.id !== "sticker_container")
    {
        if (sticker != null){
            sticker.classList.remove('selected_stick');
        }
        if (e.target === sticker){
            sticker = null;
            filterCtx.clearRect(0, 0, width, height);
        } else {
            e.target.classList.add('selected_stick');
            sticker = e.target;
            newImg = new Image();
            newImg.src = sticker.src;
            if (sticker)
            {
                filterCtx.clearRect(0, 0, width, height);
                filterCtx.filter = filter;
                filterCtx.drawImage(newImg, filterX, filterY, stikerWidth, stikerHeight);
                takePhoto.removeAttribute('disabled');
                classInactive[0].classList.add('active_click');
            }
        }
    }
});

filterCanvas.onmousedown = function(event) {
    if(sticker) {
        moveAt(event.clientX, event.clientY);

        function moveAt(pageX, pageY) {
            filterX = pageX - ((document.body.offsetWidth - filterCanvas.offsetWidth) / 2) - stikerWidth / 2;
            filterY = pageY - (filterCanvas.getBoundingClientRect().top) - stikerHeight / 2;
            filterCtx.clearRect(0, 0, width, height);
            filterCtx.filter = filter;
            filterCtx.drawImage(newImg, filterX, filterY, stikerWidth, stikerHeight);
        }

        function onMouseMove(event) {
            moveAt(event.clientX, event.clientY);
        }

        filterCanvas.addEventListener('mousemove', onMouseMove);

        document.body.onmouseup = function() {
            filterCanvas.removeEventListener('mousemove', onMouseMove);
            document.body.onmouseup = null;
        };
    }
};

filterCanvas.ondragstart = function() {
    return false;
};


function addImage(response){
    let edited_block = document.getElementById("edited_photos");
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

let onLoad = false;
let k = 1;
let xImg = 0;
let yImg = 0;

uploadfile.addEventListener('change', function(e){
    canvas.width = width;
    canvas.height = height;
    uploadImg = new Image;
    uploadImg.src = URL.createObjectURL(e.target.files[0]);
    uploadImg.onload = function() {
        canvasCtx.clearRect(0, 0, width, height);
        canvasCtx.filter = filter;
        canvasCtx.drawImage(uploadImg, xImg, yImg, width * k, height * k, 0, 0, width, height);
        canvasData = canvas.toDataURL("image/png");
        onLoad = true;
    };
    document.addEventListener('keydown', function(event) {
        if (event.defaultPrevented) {
            return; // Do nothing if the event was already processed
        }
        if (event.code == 'Equal') {
            k -= 0.1;
        }
        else if (event.code == 'Minus') {
            k += 0.1;
        }
        else if (event.code == 'ArrowRight') {
            xImg -= 10;
        }
        else if (event.code == 'ArrowLeft') {
            xImg += 10;
        }
        else if (event.code == 'ArrowUp') {
            yImg += 10;
        }
        else if (event.code == 'ArrowDown') {
            yImg -= 10;
        }

        canvasCtx.clearRect(0, 0, width, height);
        canvasCtx.filter = filter;
        canvasCtx.drawImage(uploadImg, xImg, yImg, width * k, height * k, 0, 0, width, height);
        canvasData = canvas.toDataURL("image/png");
        event.preventDefault();
    }, true);

});

takePhoto.addEventListener(
    'click',
    function(e){
        if(onLoad === false){
            canvas.width = width;
            canvas.height = height;
            canvasCtx.filter = filter;
            canvasCtx.drawImage(video, 0, 0, width, height);
            canvasData = canvas.toDataURL("image/png");
        } else {
            canvasCtx.filter = filter;
            canvasCtx.drawImage(uploadImg, xImg, yImg, width * k, height * k, 0, 0, width, height);
            canvasData = canvas.toDataURL("image/png");
        }
        saveBtn.removeAttribute('disabled');
        classInactive[1].classList.add('active_click');
        e.preventDefault();
    }, false);

reset_btn.addEventListener('click', function(){
    filter = 'none';
    filterCtx.filter = filter ;
    sticker = null;
    canvasData = null;
    uploadfile.value = "";
    onLoad = false;
    video.className = '';
    filterX = 0;
    filterY = 0;
    filterCtx.clearRect(0, 0, width, height);
    canvas.getContext('2d').clearRect(0, 0, width, height);

    if(!takePhoto.hasAttribute('disabled')){
        takePhoto.setAttribute('disabled', 'true');
    }
    saveBtn.setAttribute('disabled', 'true');
    classInactive[0].classList.remove('active_click');
    classInactive[1].classList.remove('active_click');
    let selected = document.querySelector('.selected_stick');
    if (selected)
        selected.classList.remove('selected_stick');
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

let filter_container = document.querySelector('#filter_container');

filter_container.addEventListener('click', function (e) {
    if (e.target.id !== "filter_container")
    {
        let idFilter = e.target.id;
        filter = filtersName[idFilter];
        video.className = idFilter;

        if (sticker){
            filterCtx.clearRect(0, 0, width, height);
            filterCtx.filter = filter;
            filterCtx.scale(-1, 1);
            filterCtx.drawImage(newImg, filterX, filterY, stikerWidth, stikerHeight);
        }
        if(onLoad){
            filterCtx.clearRect(0, 0, width, height);
            canvasCtx.filter = filter;
            canvasCtx.drawImage(uploadImg, xImg, yImg, width * k, height * k, 0, 0, width, height);
        }
        takePhoto.removeAttribute('disabled');
        classInactive[0].classList.add('active_click');
    }
});

