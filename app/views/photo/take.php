<?php
$numberOfStikers = 12;

$btns = [
    "0" => [
            "id" => "stopbt",
            "type" => "button",
            "photo" => "photo-camera"
    ],
    "1" => [
            "id" => "fileupload",
            "type" => "file",
            "photo" => "upload"
    ],
    "2" => [
            "id" => "reset_btn",
            "type" => "button",
            "photo" => "reset"
    ],
    "3" => [
            "id" => "save_btn",
            "type" => "button",
            "photo" => "save"
    ]
]
?>


<div class="wrap_webcam">

    <div class="res"></div>
    <div class="video">
        <canvas id="photo_canvas" style="position: absolute;z-index:2;"></canvas>
        <canvas id="filter_canvas" style="position: absolute;z-index:3;"></canvas>
        <video id="video" autoplay></video>
    </div>
    <div class="webcam_btns">
        <?php
            for($i = 0; $i < count($btns); $i++){
        ?>
                <label for="<?php echo $btns[$i]["id"]?>">
                    <img src="/camagru_mvc/public/image/<?php echo $btns[$i]["photo"] ?>.png" alt="<?php echo $btns[$i]["photo"]?>">
                    <input type="<?php echo $btns[$i]["type"]?>" id="<?php echo $btns[$i]["id"]?>">
                </label>
        <?php
            }
        ?>
    </div>
    <div id="filter_container">
        <?php
            for($i = 0; $i < count($vars['filters']); $i++){ ?>
                <img id="stiker_<?php echo $i?>" src="<?php echo $vars['filters'][$i]['path']?>" draggable="true">
            <?php   }
            ?>
    </div>
    <div class="edited_photos">
        <?php
            for($i = 0; $i < count($vars['edited_photos']); $i++){ ?>
                 <img id="edited_<?php echo $i?>" src="<?php echo $vars['edited_photos'][$i]['path']?>">
        <?php   }
        ?>
    </div>
</div>
<script src="/camagru_mvc/public/scripts/camera.js"></script>