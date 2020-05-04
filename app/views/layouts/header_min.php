<?php
$uri = explode( '?', $_SERVER['REQUEST_URI'])
?>

<div class="wrapper">
    <header>
        <div class="photo_acc_min">
                <div class="to_profile">
                    <form action="<?php echo DIR_NAME;?>/default/index">
                        <label for="to_profile">
                            <p class="crop_min">
                                <img class="avatar_min" src="<?php echo $vars['avatar']?>" alt="avatar">
                            </p>

                            <input id="to_profile" type="submit" value=""/>
                        </label>
                    </form>
                </div>
                <div class="login_min"><?php if($vars['info']) { echo $vars['info'][0]['login']; } else { echo "GUEST";} ?></div>
                <div class="to_sign_up">
                    <?php if ($uri[0] === DIR_NAME . '/gallery/gallery' || $uri[0] === DIR_NAME . '/gallery/photo') { ?>
                        <form action="<?php echo DIR_NAME;?>/photo/take">
                            <label for="camera">
                                <img src="<?php echo DIR_NAME;?>/public/image/photo-camera.svg" alt="PUBLIC GALLERY">
                            </label>
                            <input id="camera" type="submit" name="submit"/>
                        </form>
                    <?php }
                        if ($uri[0] === DIR_NAME . '/photo/take' || $uri[0] === DIR_NAME . '/gallery/photo') { ?>
                            <form action="<?php echo DIR_NAME;?>/gallery/gallery">
                                <label for="public_gallery">
                                    <img src="<?php echo DIR_NAME;?>/public/image/gallery.svg" alt="PUBLIC GALLERY">
                                </label>
                                <input id="public_gallery" type="submit" name="submit"/>
                            </form>
                      <?php  } ?>
                    <form action="<?php echo DIR_NAME;?>/account/logout">
                        <label for="sign_out_photo">
                            <img src="<?php echo DIR_NAME;?>/public/image/sign-out.png" alt="">
                            <input id="sign_out_photo" type="submit" value=""/>
                        </label>
                    </form>
                </div>
        </div>
    </header>

