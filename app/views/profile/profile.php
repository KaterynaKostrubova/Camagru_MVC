<div class="allSettings">
    <form method="post" action="/camagru_mvc/profile/edit">
        <div class="profileAvatar">
            <img src="https://images.pexels.com/photos/104827/cat-pet-animal-domestic-104827.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"  alt="ava">
        </div>
        <div class="nickname">
            <p id ="currentName">Name:<?php echo $vars['info'][0]['login']?></p>
        </div>
        <div class="email">
            <p id ="currentEmail">Email:<?php echo $vars['info'][0]['email']?></p>
        </div>
        <input type="submit" name="submit" id="edit" class="active" value="edit">
<!--        <p>Email: --><?php //echo $vars['info'][0]['email']?><!--Edit</p>-->
<!--        <p>Change password--><?php //?><!--</p>-->
    </form>
</div>
<script src="/camagru_mvc/public/scripts/profile.js"></script>










