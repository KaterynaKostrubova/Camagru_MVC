<div class="wrapper">
    <header>
        <div class="photo-acc">
            <div class="top_buttons">
                <div class="takePhoto">
                    <form action="<?php echo DIR_NAME; ?>/photo/take">
                        <label for="camera">
                            <img src="<?php echo DIR_NAME; ?>/public/image/photo-camera.svg" alt="">
                        </label>
                        <input id="camera" type="submit">
                    </form>
                </div>
                <form action="<?php echo DIR_NAME; ?>/gallery/gallery">
                    <label for="public_gallery">
                        <img src="<?php echo DIR_NAME; ?>/public/image/gallery.svg" alt="PUBLIC GALLERY">
                    </label>
                    <input id="public_gallery" type="submit" name="submit" value="ok"/>
                </form>
                <div class="logout">
                    <form action="<?php echo DIR_NAME; ?>/account/logout">
                        <label for="logout">
                            <img src="<?php echo DIR_NAME; ?>/public/image/sign-out.png" alt="">
                        </label>
                        <input id="logout" type="submit">
                    </form>
                </div>
            </div>
        </div>
        <div class="avatar-block">
            <p class="crop">
                <img class="avatar" src="<?php echo $vars['avatar']?>" alt="avatar">
            </p>
            <div class="login"><?php echo $vars['info'][0]['login']?></div>
        </div>
        <div class="buttons">
            <ul class="select" id="select_block" onclick="addActiveClass(event)"">
            <li id="gal" class="active">
                <img src="<?php echo DIR_NAME; ?>/public/image/gallery.svg"  alt="">
            </li>
            <li  id="sett">
                <img src="<?php echo DIR_NAME; ?>/public/image/gear.svg" alt="">
            </li>
            </ul>
        </div>
    </header>
    <script>
        let bg = document.querySelector('.photo-acc');
        bg.style.backgroundImage = 'url(<?php echo $vars['bg_photo']?>)';
    </script>

