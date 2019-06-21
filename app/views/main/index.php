<?php //include('main.php');
//header('Location: /camagru_mvc/default/setup');
//include ('main.php');
?>

<p>Main page!!!!</p>
<!--<p>Name: <b> --><?php //echo $name; ?><!--</b></p>-->
<!--<p>Age: <b> --><?php //echo $age; ?><!--</b></p>-->

<!--<p>--><?php //debug($arr); ?><!--</p>-->
<form action="/camagru_mvc/account/logout">
    <input type="submit" value="logout">
</form>

<?php //debug($users);?>

<?php foreach ($users as $val): ?>
    <h3><?php echo $val['login']?></h3>
    <p><?php echo $val['email']?></p>
        <hr>
<?php endforeach; ?>
