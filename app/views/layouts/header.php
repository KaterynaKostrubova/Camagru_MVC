<header>
    <div class="photo-acc">
        <img class="bg_photo" src="<?php echo $vars['bg_photo']?>" alt="bg">
        <img class="avatar" src="<?php echo $vars['avatar']?>" alt="avatar">
        <div class="login"><?php echo $vars['info'][0]['login']?></div>

<!--        --><?php //echo var_dump($vars)?>
    </div>
    <div class="buttons">
        <div class="takePhoto">
            <form action="/camagru_mvc/photo/take">
                <label for="camera">
                    <img src="/camagru_mvc/public/image/photo-camera.png" alt="">
                </label>
                <input id="camera" type="submit">
            </form>
        </div>
        <div class="btn_gallery">
            <form action="/camagru_mvc/gallery/gallery">
                <label for="gallary">
                    <img src="/camagru_mvc/public/image/art.png" alt="">
                </label>
                <input id="gallary" type="submit"/>
            </form>
        </div>
        <div class="profile">
            <form class="setProfile" method="GET" action="/camagru_mvc/profile/profile">
                <label for="settings">
                    <img src="/camagru_mvc/public/image/gear.png" alt="">
                </label>
                <input id="settings" type="submit"/>
            </form>
        </div>
        <div class="logout">
            <form action="/camagru_mvc/account/logout">
                <label for="logout">
                    <img src="/camagru_mvc/public/image/enter.png" alt="">
                </label>
                <input id="logout" type="submit">
            </form>
        </div>
    </div>
</header>
