<div id="video-bg">
    <video width="100%" height="auto" preload="auto" autoplay="autoplay" loop="loop" poster="">
        <source src="/camagru_mvc/public/image/bg-video.mp4" type="video/mp4"></source>
    </video>
</div>
<div class="wrap">
<!--    <section class='gallery'>-->
<!--        --><?php //for($i = 0; $i < count($vars['photo']); $i++){?>
<!--            <input type="radio" id="--><?php //echo 'id-' . $i ?><!--" value="--><?php //echo $i ?><!--" name="tractor" --><?php //if($i === 0) echo "checked='checked'" ?><!-- />-->
<!--            <article class="card --><?php //echo 'photo-' . $i ?><!--">-->
<!--                <label for="--><?php //echo 'id-' . $i ?><!--" class="--><?php //echo 'label-' . $i ?><!--">-->
<!--                    <img src="--><?php //echo $vars['photo'][$i]['path']?><!--" alt="">-->
<!--                </label>-->
<!--            </article>-->
<!--        --><?php //}?>
<!--    </section>-->
    <section class='gallery'>
        <?php for($i = 0; $i < count($vars['photo']); $i++){?>
            <img class="photo photo-<?php echo $i?>" src="<?php echo $vars['photo'][$i]['path']?>" alt="">
        <?php }?>
    </section>
    <div class="wrap_form">
        <div class="form">
            <ul class="select" onclick="addActiveClass(event)"">
            <?php if(isset($_COOKIE['login'])){?>
                <li id="register">Sign Up</li>
                <li  id="login" class="active">Log In</li>
            <?php } else {?>
                <li id="register" class="active">Sign Up</li>
                <li  id="login">Log In</li>
            <?php }?>
            </ul>
            <div class = "tab">
                <div <?php if(isset($_COOKIE['login'])){?> style="display: none;"<?php }?> id="sign_up">
                    <h1>Welcome to Camagru!</h1>
                    <!--            onsubmit="alert('Please, confirm email!')"-->
                    <form class="login_signup" action="/camagru_mvc/account/signup?action=signup" method="post" class="sign_up_form" >
                        <p>
                            <span><i class="fas fa-user"></i></span>
                            <input type="text" name="name" value="" placeholder="Name" pattern="[A-Za-z]{1}[A-Za-z-0-9]{3,32}"
                                   title="Can't begin with a number. Can contain letter, number and at least 3 and no more 32 characters" required />
                        </p>
                        <p>
                            <span><i class="fas fa-at"></i></span>
                            <input type="email" name="email" placeholder="email@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required />
                        </p>
                        <p>
                            <span><i class="fas fa-key"></i></span>
                            <input type="password" name="passwd" placeholder="Set a password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required />
                        </p>
                        <p id="sbm"><input class="button_subm" type="submit" name="submit" value="Get started" autofocus /></p>
                    </form>
                </div>
                <div <?php if(isset($_COOKIE['login'])){?> style="display: block;" <?php }?> id="log_in">
                    <h1>Welcome Back!</h1>
                    <form class="login_signup" action="/camagru_mvc/account/signup?action=login" method="post" class="log_in_form">
                        <p>
                            <span><i class="fas fa-user"></i></span>
                            <input  type="text" name="name" value="" placeholder="Name"  required />
                        </p>
                        <p>
                            <span><i class="fas fa-key"></i></span>
                            <input type="password" name="passwd" value="" placeholder="Password" required />
                        </p>
                        <p><input class="button_subm" type="submit" name="submit" value="OK" autofocus /></p>
                    </form>
                    <form class="invisible_btn" action="/camagru_mvc/account/changepass">
                        <label for="forgot_input">Forgot your password?</label>
                        <input id="forgot_input" type="submit" name="submit" value="ok"/>
                    </form>
                </div>
            </div>
            <form class="invisible_btn" action="/camagru_mvc/gallery/gallery" method="post" class="sign_up_form" >
                <label for="gallary_btn">Go to Gallary</label>
                <input id="gallary_btn" type="submit" name="submit" value="ok"/>
            </form>
        </div>
    </div>
</div>

<script src="/camagru_mvc/public/scripts/scripts.js"></script>