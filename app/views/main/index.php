<div class="wrapper">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/camagru_mvc/app/views/layouts/header.php';?>
        <div class="user_gallery">
            <?php for($i = 0; $i < count($vars['photos']); $i++) {?>
                <img class="photo photo-<?php echo $i?>" src="<?php echo $vars['photos'][$i]['path']?>" alt="" width="200" height="200">
            <?php }?>
        </div>
    <?php include "footer.php";?>
</div>