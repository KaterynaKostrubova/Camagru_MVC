<?php include "header.php";?>

<div class="userInfo">
    <div class="avatar"></div>
    <form class="setProfile" action="/camagru_mvc/default/profile">
        <input id="settings" type="submit" name="submit" value="Go to profile"/>
    </form>
</div>


<?php var_dump($users);?>

<?php //foreach ($users as $val): ?>
<!--    <h3>--><?php //echo $val['login']?><!--</h3>-->
<!--    <p>--><?php //echo $val['email']?><!--</p>-->
<!--        <hr>-->
<?php //endforeach; ?>
