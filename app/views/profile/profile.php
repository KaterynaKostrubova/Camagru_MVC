<?php //include "../main/header.php";?>
<div class="allSettings">
    <form method="post" id="form">
        <div class="data_first">
            <div class="profileAvatar">
                <img src="https://images.pexels.com/photos/104827/cat-pet-animal-domestic-104827.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"  alt="ava">
            </div>
            <div style="display: flex;">
                <input type="submit" name="submit" id="save" class="hide" value="save">
                <div id="loader" style="flex: 1; color: white;">Saving...</div>
            </div>
        </div>
        <div class="data_second">
            <div class="nickname">
                <input type="text"  name="name" id ="editName" value="<?php echo $vars['info'][0]['login']?>">
            </div>
            <div class="email">
                <input type="email"  name="email" id ="editEmail" value="<?php echo $vars['info'][0]['email']?>">
            </div>
            <div class="password">
                <input type="password"  name="password" id ="editEmail" value="23134234234">
                <input type="password"  name="password" id ="editEmail" value="23134234234">
            </div>
        </div>

<!--        --><?php //var_dump($vars);?>

<!--        --><?php //echo $response?>
        <!--        <p>Email: --><?php //echo $vars['info'][0]['email']?><!--Edit</p>-->
        <!--        <p>Change password--><?php //?><!--</p>-->
    </form>
</div>
<script src="/camagru_mvc/public/scripts/profile.js"></script>
