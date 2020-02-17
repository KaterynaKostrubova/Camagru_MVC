
let filter = null;
let streaming = false;
let video = document.querySelector('#video');
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



navigator.getUserMedia = navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia;


let widthWin = document.documentElement.clientWidth;
if (widthWin > 720){
    width = 720;
    height = 480;
} else if (widthWin <= 720 && widthWin >= 480){
    width = 480;
    height = 320;
} else {
    width = 320;
    height = 256;
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
    var img = new Image;
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
        if (filter != null)
            filter.style.border = "none";
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
                filterCtx.drawImage(newImg, filterX, filterY , 200, 200);
            }
        }
    }
});

saveBtn.addEventListener('click', function(e){
    if (filter != null)
    {
        filterData = filterCanvas.toDataURL("image/png");


        // if (!canvasData)
        //     document.getElementById("res").innerHTML = "Please take a picture !";
        // else {
        //     var param = {
        //         "data" : canvasData,
        //         "filter" : filterData
        //     };
        //     var single_param = create_param(param);
        //     var xmlhttp = new XMLHttpRequest();
        //     /* AJAX WITHOUT JQUERY */
        //     xmlhttp.onreadystatechange = function() {
        //         if (xmlhttp.readyState == XMLHttpRequest.DONE ) {
        //             if (xmlhttp.status == 200 || xmlhttp.status == 201) {
        //                 var data = xmlhttp.responseText;
        //                 if (data == 'Success')
        //                 {
        //                     document.getElementById("res").innerHTML = "Pix uploaded in the gallery";
        //                 }
        //                 else
        //                     document.getElementById("res").innerHTML = "Fail";
        //             }
        //             else
        //                 alert('Something Went Wrong');
        //         }
        //     };
        //
        //     xmlhttp.open("POST", "save.php", true);
        //     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        //     xmlhttp.send(single_param);
        //     /* AJAX WITHOUT JQUERY */
        // }


        e.preventDefault();
    }
    else
        alert("FILTER IS NULL");
}, false);


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