<div class="wrapper">
    <header>
        <div class="photo-acc">
            <img class="bg_photo" src="<?php echo $vars['bg_photo']?>" alt="bg">
            <p class="crop">
                <img class="avatar" src="<?php echo $vars['avatar']?>" alt="avatar">
            </p>

            <div class="login"><?php echo $vars['info'][0]['login']?></div>
            <div class="top_buttons">
                <div class="takePhoto">
                    <form action="/camagru_mvc/photo/take">
                        <label for="camera">
                            <img src="/camagru_mvc/public/image/photo-camera.svg" alt="">
                        </label>
                        <input id="camera" type="submit">
                    </form>
                </div>
                <form action="/camagru_mvc/gallery/gallery">
                    <label for="public_gallery">
                        <img src="/camagru_mvc/public/image/gallery.svg" alt="PUBLIC GALLERY">
                    </label>
                    <input id="public_gallery" type="submit" name="submit" value="ok"/>
                </form>
                <div class="logout">

                    <form action="/camagru_mvc/account/logout">
                        <label for="logout">
                            <img src="/camagru_mvc/public/image/sign-out.png" alt="">
                        </label>
                        <input id="logout" type="submit">
                    </form>
                </div>
            </div>
        </div>
        <div class="buttons">
            <ul class="select" id="select_block" onclick="addActiveClass(event)"">
            <li id="gal" class="active">
                <img src="/camagru_mvc/public/image/gallery.svg"  alt="">
            </li>
            <li  id="sett">
                <img src="/camagru_mvc/public/image/gear.svg" alt="">
            </li>
            </ul>
        </div>
    </header>

