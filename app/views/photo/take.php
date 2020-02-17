<div class="wrap_webcam">
    <div class="res"></div>
    <div class="video">
        <canvas id="photo_canvas" style="position: absolute;z-index:2;"></canvas>
        <canvas id="filter_canvas" style="position: absolute;z-index:3;"></canvas>
<!--        <img src="" alt="" class="photo">-->
<!--        <img class="frame" src="/camagru_mvc/public/image/frame.png" alt="">-->
        <video id="video" autoplay></video>

    </div>
    <div class="webcam_btns">
        <input type="button" id="stopbt" value="stop">
        <input type="button" id="reset_btn" value="reset">
        <input type="button" id="save_btn" value="save">
        <input type="file" id="fileupload" accept="image/*" />
<!--        <input type="button" id="save_btn" value="save to profile">-->
<!--        <a id="dl-btn" href="#" download="pic_.png">Save</a>-->
    </div>
    <div id="filter_container">
        <img id="filter_1" src="/camagru_mvc/public/image/art.png" draggable="true">
        <img id="filter_2" src="/camagru_mvc/public/image/enter.png" draggable="true">
        <img id="filter_3" src="/camagru_mvc/public/image/gear.png" draggable="true">
        <img id="filter_4" src="/camagru_mvc/public/image/photo-camera.png" draggable="true">
    </div>
</div>
<script src="/camagru_mvc/public/scripts/camera.js"></script>