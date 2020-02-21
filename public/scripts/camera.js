
let filter = null;
let streaming = false;
let video = document.querySelector('#video');
let videoClass = document.querySelector('.video');
let constraints = {};

let canvas = document.querySelector('#photo_canvas');
let filterCanvas = document.querySelector('#filter_canvas');
let filterCtx = filterCanvas.getContext('2d');

let uploadfile = document.querySelector('#fileupload');

let saveBtn = document.querySelector('#save_btn');
let reset_btn = document.querySelector('#reset_btn');
let takePhoto = document.querySelector('#stopbt');

// let filter_list = document.querySelector('#filter_container').getElementsByTagName('img');
let filter_container = document.querySelector('#filter_container');

let newImg = null;

let canvasData   = null;
let filterData = null;
let width = 960;
let height = 720;
let stikerWidth = 200;
let stikerHeight = 200;

// document.addEventListener('click',e => console.log(e.target))


navigator.getUserMedia = navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia;


let widthWin = document.documentElement.clientWidth;
if (widthWin > 720){
    width = 720;
    height = 480;
    stikerWidth = 200;
    stikerHeight = 200;
} else if (widthWin <= 720 && widthWin >= 480){
    width = 480;
    height = 320;
    stikerWidth = 100;
    stikerHeight = 100;
} else {
    width = 320;
    height = 256;
    stikerWidth = 50;
    stikerHeight = 50;
}

let filterX = width / 2 - 100;
let filterY = height / 2 - 100;

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
        // console.log(canvasData);
        e.preventDefault();
    }, false);

reset_btn.addEventListener('click', function(){
    filterCtx.clearRect(0, 0, width, height);
    filter = null;
    canvas.getContext('2d').clearRect(0, 0, width, height);
    canvasData = null;
    uploadfile.value = "";
}, false);

filter_container.addEventListener('click',  function(e){
    if (e.target.id != "filter_container")
    {
        if (filter != null){
            filter.style.border = "none";
        }
        if (e.target == filter){
            filter = null;
            filterCtx.clearRect(0, 0, width, height);
        } else {
            e.target.style.border = "2px solid white";
            filter = e.target;
            newImg = new Image();
            newImg.src = filter.src;
            if (filter)
            {
                filterCtx.clearRect(0, 0, width, height);
                filterCtx.drawImage(newImg, filterX - 100, filterY - 100, 200, 200);
            }
        }
    }
});


function addImage(response){
    let edited_block = document.getElementById("edited_photos");
    let json_data = JSON.parse(response);

    let div = document.createElement("div");
    div.className = "img_block_" + json_data['id'];
    edited_block.prepend(div);

    let img = document.createElement("img");
    img.id = "edited_" + json_data['id'];
    img.className = "edited";
    img.src = json_data['photo'];
    div.prepend(img);

    let inp = document.createElement("input");
    inp.className = 'delete';
    inp.id = "delete_" + json_data['id'];
    inp.type = "button";
    inp.value = "delete";
    div.append(inp);
}



let saveResponse = function(request) {
    let response = request.response;
    console.log(response);
    console.log("saved");
    addImage(response);
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
    let del = document.querySelector('.img_block_' + response['id']);
    del.remove();
    console.log(response['id']);
    // console.log("saved");
};


let delBtn = document.querySelector('#edited_photos');


delBtn.addEventListener('click', function(e){

    let req = new Requests();
    let id = e.target.id.split('_')[1] + '';
    // console.log(id);
    str ='';
    let data = {
        'id' : id,
    };
    req.post('/camagru_mvc/api/delete/photo', delResponse, str, data);
    e.preventDefault();
}, false);



function create_param(param){
    var parameterString = "";
    var isFirst = true;
    for(let i in param) {
        if(!isFirst) {
            parameterString += "&";
        }
        parameterString += encodeURIComponent(i) + "=" + encodeURIComponent(param[i]);
        isFirst = false;
    }
    return (parameterString);
}



filterCanvas.onmousedown = function(event) { // (1) отследить нажатие
    // (2) подготовить к перемещению:
    // разместить поверх остального содержимого и в абсолютных координатах
    filterCanvas.style.position = 'absolute';
    filterCanvas.style.zIndex = 1000;
    // переместим в body, чтобы мяч был точно не внутри position:relative
    document.body.append(filterCanvas);
    // и установим абсолютно спозиционированный мяч под курсор

    moveAt(event.pageX, event.pageY);

    // передвинуть под координаты курсора
    // и сдвинуть на половину ширины/высоты для центрирования
    function moveAt(pageX, pageY) {
        filterCanvas.style.left = pageX - filterCanvas.offsetWidth / 2 + 'px';
        filterCanvas.style.top = pageY - filterCanvas.offsetHeight / 2 + 'px';
    }

    function onMouseMove(event) {
        moveAt(event.pageX, event.pageY);
    }

    // (3) перемещать по экрану
    document.addEventListener('mousemove', onMouseMove);

    // (4) положить мяч, удалить более ненужные обработчики событий
    filterCanvas.onmouseup = function() {
        document.removeEventListener('mousemove', onMouseMove);
        filterCanvas.onmouseup = null;
    };

};

filterCanvas.ondragstart = function() {
    return false;
};
