<div class="wrapper">
    <header>
        <div class="photo_acc_min">
                <div class="to_profile">
                    <form action="/camagru_mvc/default/index">
                        <label for="to_profile">
                            <p class="crop_min">
                                <img class="avatar_min" src="<?php echo $vars['avatar']?>" alt="avatar">
                            </p>

                            <input id="to_profile" type="submit" value=""/>
                        </label>
                    </form>
                </div>
                <div class="login_min"><?php echo $vars['info'][0]['login']?></div>
                <div class="to_sign_up">
                    <?php if ($_SERVER['REQUEST_URI'] != '/camagru_mvc/gallery/gallery') { ?>
                        <form action="/camagru_mvc/gallery/gallery">
                            <label for="public_gallery">
                                <img src="/camagru_mvc/public/image/gallery.svg" alt="PUBLIC GALLERY">
                            </label>
                            <input id="public_gallery" type="submit" name="submit" value="ok"/>
                        </form>
                    <?php } ?>
                    <form action="/camagru_mvc/account/logout">
                        <label for="sign_out_photo">
                            <img src="/camagru_mvc/public/image/sign-out.png" alt="">
                            <input id="sign_out_photo" type="submit" value=""/>
                        </label>
                    </form>
                </div>
        </div>
    </header>

