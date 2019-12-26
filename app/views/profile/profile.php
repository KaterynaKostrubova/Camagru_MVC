<?php include $_SERVER['DOCUMENT_ROOT'] . '/camagru_mvc/app/views/layouts/header.php';?>
<div class="allSettings">
    <form method="post" id="form">
        <div class="data_first">
<!--            <div class="profileAvatar">-->
<!--                <img src="https://images.pexels.com/photos/104827/cat-pet-animal-domestic-104827.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"  alt="ava">-->
<!--            </div>-->
            <div style="display: flex;">
                <input type="submit" name="submit" id="save" class="hide" value="save" onclick="myFunction()">
                <div id="loader" style="flex: 1; color: white;">Saving...</div>
            </div>
        </div>
        <div class="data_second">
            <div class="nickname">
                <input type="text"  name="name" id ="editName" value="<?php echo $vars['info'][0]['login']?>" placeholder="Name" pattern="[A-Za-z]{1}[A-Za-z-0-9]{3,32}" required>
                <div class="popup" onclick="myFunction()">
                    Click me to toggle the popup!
                    <span class="popuptext" id="myPopup">name successfully update</span>
                </div>
            </div>
            <div class="email">
                <input type="email"  name="email" id ="editEmail" value="<?php echo $vars['info'][0]['email']?>">
            </div>
            <div class="password">
                <input type="password"  name="password" id ="editEmail" value="23134234234">
                <input type="password"  name="password" id ="editEmail" value="23134234234">
                <input type="text"  name="email" id ="editEmail" value="<?php echo $vars['info'][0]['email']?>" placeholder="email@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            </div>
            <div class="notification">
                <label for="sendToEmail">Send notification to email</label>
                 <input name="notification" id="sendToEmail" type="checkbox" <?php if($vars['info'][0]['notification'] === '1') echo 'checked'; ?>
            </div>
        </div>
    </form>
    <form class="forgot_form" action="/camagru_mvc/account/changepass">
        <label for="reset_input">reset password</label>
        <input style="display: none;" id="reset_input" type="submit" name="submit" value="reset pass"/>
    </form>
    <?php //var_dump($vars['info']); ?>

</div>
<script src="/camagru_mvc/public/scripts/profile.js"></script>
