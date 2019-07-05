<div class="allSettings">
    <form method="post" action="/camagru_mvc/profile/profile">
        <div class="profileAvatar">
            <img src="https://images.pexels.com/photos/104827/cat-pet-animal-domestic-104827.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"  alt="ava">
        </div>
        <div class="nickname">
            <input type="text"  name="name" id ="editName" value="<?php echo $vars['info'][0]['login']?>">
        </div>
        <div class="email">
            <input type="text"  name="name" id ="editEmail" value="<?php echo $vars['info'][0]['email']?>">
        </div>
        <input type="submit" name="submit" id="save" class="hide" value="save">

        <!--        <p>Email: --><?php //echo $vars['info'][0]['email']?><!--Edit</p>-->
        <!--        <p>Change password--><?php //?><!--</p>-->
    </form>
</div>
<script src="/camagru_mvc/public/scripts/profile.js"></script>