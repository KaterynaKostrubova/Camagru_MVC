<form action="/camagru_mvc/account/logout">
    <input type="submit" value="logout">
</form>
<form class="setProfile" action="/camagru_mvc/default/profile">
    <input id="settings" type="submit" name="submit" value="Go to profile"/>
</form>

<?php var_dump($users);?>

<?php //foreach ($users as $val): ?>
<!--    <h3>--><?php //echo $val['login']?><!--</h3>-->
<!--    <p>--><?php //echo $val['email']?><!--</p>-->
<!--        <hr>-->
<?php //endforeach; ?>
