<p>Main page!!!!</p>
<!--<p>Name: <b> --><?php //echo $name; ?><!--</b></p>-->
<!--<p>Age: <b> --><?php //echo $age; ?><!--</b></p>-->

<!--<p>--><?php //debug($arr); ?><!--</p>-->

<?php //debug($users);?>

<?php foreach ($users as $val): ?>
    <h3><?php echo $val['login']?></h3>
    <p><?php echo $val['email']?></p>
        <hr>
<?php endforeach; ?>
<?php //include('main.php'); ?>

