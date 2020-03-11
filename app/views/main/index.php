<?php include $_SERVER['DOCUMENT_ROOT'] . '/camagru_mvc/app/views/layouts/header.php';?>
<div class="main">
    <div id="user_gallery">
        <?php if (count($vars['photos']) > 0){
            for($i = 0; $i < count($vars['photos']); $i++) {?>
                <div class="block">
                    <img class="photo photo-<?php echo $vars['photos'][$i]['id']?>" src="<?php echo $vars['photos'][$i]['path']?>" alt="">
                    <div class="btns">
                        <input type="button" class="change_ava" id="change_<?php echo $vars['photos'][$i]['id']?>_<?php echo $vars['photos'][$i]['user_id']?>" onclick="changeAvatar(event)" value="avatar">
                        <input type="button" class="change_bg" id="changebg_<?php echo $vars['photos'][$i]['id']?>_<?php echo $vars['photos'][$i]['user_id']?>" onclick="changeBg(event)" value="background">
                    </div>
                </div>
            <?php }
        } else {
            echo "There will be your photo!";
        } ?>

    </div>
    <div id="user_settings">
        <h1>You can edit your profile info</h1>
        <form method="post" id="form">
            <div class="data">
                <div class="nickname">
                    <h2>Name</h2>
                    <input type="text"  class="field" name="name" id ="editName" value="<?php echo $vars['info'][0]['login']?>" placeholder="Name" pattern="[A-Za-z]{1}[A-Za-z-0-9]{3,32}" required>
                    <div class="popup" onclick="myFunction()">
                        Click me to toggle the popup!
                        <span class="popuptext" id="myPopup">name successfully update</span>
                    </div>
                </div>
                <div class="email">
                    <h2>Email</h2>
                    <input type="email"  class="field" name="email" id ="editEmail" value="<?php echo $vars['info'][0]['email']?>">
                </div>
                <div class="password">
                    <h2>Password</h2>
                    <input type="password"  class="field" name="password" id ="editEmail" value="23134234234">
                    <input type="password" class="field"  name="password" id ="editEmail" value="23134234234">
                </div>
                <div class="bot">
                    <div class="notification">

                        <label for="sendToEmail" class="container">Send notification to email
                            <input name="notification" id="sendToEmail" type="checkbox" <?php if($vars['info'][0]['notification'] === '1') echo 'checked'; ?>>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="default-avatar">
                        <label for="defAvatar">
                            <input id="defAvatar" type="button" value="Set default avatar" onclick="changeAvatar(event)">
                        </label>
                    </div>
                </div>
                <input type="submit" name="submit" id="save" class="hide field" value="save" onclick="myFunction()">
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