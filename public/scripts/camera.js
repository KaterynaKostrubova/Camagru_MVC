navigator.getUserMedia = navigator.getUserMedia ||
    navigator.webkitGetUserMedia ||
    navigator.mozGetUserMedia;
let video = document.querySelector('video');

if (navigator.getUserMedia) {
    console.log("1");
    navigator.getUserMedia({ audio: false, video: { width: 480, height: 360 } },
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

document.querySelector('#stopbt').addEventListener(
    'click',
    function(e){
        let video = document.querySelector('video');
        let hidden_canvas = document.querySelector('canvas');
        let image = document.querySelector('img.photo');
        // Получаем размер видео элемента.
        let width = video.videoWidth;
        let height = video.videoHeight;

        // Объект для работы с canvas.
        let context = hidden_canvas.getContext('2d');

        // Установка размеров canvas идентичных с video.
        hidden_canvas.width = width;
        hidden_canvas.height = height;

        // Отрисовка текущего кадра с video в canvas.
        context.drawImage(video, 0, 0, width, height);
        hidden_canvas.style.display="none";
        // Преобразование кадра в изображение dataURL.
        var imageDataURL = hidden_canvas.toDataURL('image/png');

        // Помещение изображения в элемент img.
        image.setAttribute('src', imageDataURL);
        document.querySelector('#dl-btn').href = imageDataURL;

    });