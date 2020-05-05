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
                    <input type="password"  class="field" name="password" id ="editPass" value="23134234234">
                    <input type="password" class="field"  name="password" id ="editPass2" value="23134234234">
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
                            <input id="defAvatar" type="button" value="default avatar" onclick="changeAvatar(event)">
                        </label>
                    </div>
                    <div class="default-bg">
                        <label for="defBg">
                            <input id="defBg" type="button" value="default cover" onclick="changeBg(event)">
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
<?php include "footer.php";?>
</div>
<script src="<?php echo DIR_NAME; ?>/public/scripts/profile.js"></script>
<script src="<?php echo DIR_NAME; ?>/public/scripts/scripts.js"></script>