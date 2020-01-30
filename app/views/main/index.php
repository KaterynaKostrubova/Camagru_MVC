<?php include $_SERVER['DOCUMENT_ROOT'] . '/camagru_mvc/app/views/layouts/header.php';?>
<div class="main">
    <div id="user_gallery">
        <?php if (count($vars['photos']) > 0){
            for($i = 0; $i < count($vars['photos']); $i++) {?>
                <img class="photo photo-<?php echo $i?>" src="<?php echo $vars['photos'][$i]['path']?>" alt="" width="200" height="200">
            <?php }
        } else {
            echo "There will be your photo!";
        } ?>

    </div>
    <div id="user_settings">
        <h1>Your can edit your profile info</h1>
        <form method="post" id="form">
            <!--        <div class="data_first">-->
            <!--            <div class="profileAvatar">-->
            <!--                <img src="--><?php //echo $vars['avatar']?><!--"  alt="ava">-->
            <!--            </div>-->
            <!--            <div>-->

            <!--            </div>-->
            <!--        </div>-->
            <div class="data">
                <div class="nickname">
                    <h2>Name</h2>
                    <input type="text"  name="name" id ="editName" value="<?php echo $vars['info'][0]['login']?>" placeholder="Name" pattern="[A-Za-z]{1}[A-Za-z-0-9]{3,32}" required>
                    <div class="popup" onclick="myFunction()">
                        Click me to toggle the popup!
                        <span class="popuptext" id="myPopup">name successfully update</span>
                    </div>
                </div>
                <div class="email">
                    <h2>Email</h2>
                    <input type="email"  name="email" id ="editEmail" value="<?php echo $vars['info'][0]['email']?>">
                </div>
                <div class="password">
                    <h2>Password</h2>
                    <input type="password"  name="password" id ="editEmail" value="23134234234">
                    <input type="password"  name="password" id ="editEmail" value="23134234234">
                </div>
                <div class="notification">

                    <label for="sendToEmail" class="container">Send notification to email
                        <input name="notification" id="sendToEmail" type="checkbox" <?php if($vars['info'][0]['notification'] === '1') echo 'checked'; ?>>
                        <span class="checkmark"></span>
                    </label>
                </div>
                <input type="submit" name="submit" id="save" class="hide" value="save" onclick="myFunction()">
                <div id="loader" style="flex: 1; color: white;">Saving...</div>
            </div>
        </form>
        <?php //var_dump($vars['info']); ?>
    </div>
</div>

</div>
<?php include "footer.php";?>
<script src="/camagru_mvc/public/scripts/profile.js"></script>
<script src="/camagru_mvc/public/scripts/scripts.js"></script>