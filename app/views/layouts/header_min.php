<div class="wrapper">
    <header>
        <div class="photo_acc_min">
                <div class="to_profile">
                    <form action="/camagru_mvc/default/index">
                        <label for="to_profile">
<!--                            <img src="/camagru_mvc/public/image/gallery.svg" alt="">-->
                            <img class="avatar_min" src="<?php echo $vars['avatar']?>" alt="avatar">
                            <input id="to_profile" type="submit" value=""/>
                        </label>
                    </form>
                </div>
<!--            <div class="usr">-->
                <div class="login_min"><?php echo $vars['info'][0]['login']?></div>
<!--            </div>-->

                <div class="to_sign_up">
                    <form action="/camagru_mvc/account/logout">
                        <label for="sign_out_photo">
                            <img src="/camagru_mvc/public/image/sign-out.png" alt="">
                            <input id="sign_out_photo" type="submit" value=""/>
                        </label>
                    </form>
                </div>
        </div>
    </header>

