<?php include $_SERVER['DOCUMENT_ROOT'] . DIR_NAME . '/app/views/layouts/header.php';?>
<div class="main">
    <div id="user_gallery">
        <div id="photo_block">

        </div>
        <div class="pagination">
            <input type="button" id="first" value="<<">
            <input type="button" id="prev" value="<">
            <button id="num-page">1</button>
            <input type="button" id="next" value=">">
            <input type="button" id="last" value=">>">
        </div>
    </div>
    <div id="user_settings">
        <h1>You can edit your profile info</h1>
        <form method="post" id="form">
            <div class="data">
                <div class="nickname">
                    <h2>Name</h2>
                    <input type="text"  class="field" name="name" id ="editName" value="<?php echo $vars['info'][0]['login']?>" placeholder="Name" pattern="[A-Za-z]{1}[A-Za-z-0-9]{3,32}" required>
                </div>
                <div class="email">
                    <h2>Email</h2>
                    <input type="email"  class="field" name="email" id ="editEmail" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php echo $vars['info'][0]['email']?>">
                </div>
                <div class="password">
                    <h2>Password</h2>
                    <label for="oldPass">Type current pass: </label>
                    <input type="password"  class="field" name="oldPass" id ="oldPass">
                    <label for="newPass">Type new pass: </label>
                    <input type="password" class="field"  name="newPass" id ="newPass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                    <label for="newPassConfirm">Confirm new pass: </label>
                    <input type="password" class="field"  name="newPassConfirm" id ="newPassConfirm" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                           title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
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
                            <input id="defAvatar" name="defavatar" type="button" value="default avatar" onclick="changeAvatar(event)">
                        </label>
                    </div>
                    <div class="default-bg">
                        <label for="defBg">
                            <input id="defBg"  name="defcover" type="button" value="default cover" onclick="changeBg(event)">
                        </label>
                    </div>
                </div>
                <input type="submit" name="submit" id="save" class="hide field" value="save">
<!--                <div id="loader" style="flex: 1; color: white;">Saving..</div>-->
            </div>
        </form>
        <?php //var_dump($vars['info']); ?>
    </div>
</div>
<?php include "footer.php";?>
<div id="popup">
    <div class="popuptext" id="myPopup">
        <div id="myPopupText"></div>
        <input type="button" id="closePopUp" value="OK">
    </div>
</div>
<script src="<?php echo DIR_NAME; ?>/public/scripts/profile.js"></script>
<script src="<?php echo DIR_NAME; ?>/public/scripts/scripts.js"></script>