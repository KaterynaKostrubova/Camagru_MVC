<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="log_form">
    <h3 class="header_text">Create a new database for your site!</h3>
    <form action="install.php" method="post" class="form">
        <p>
            <span><i class="fas fa-user"></i></span>
            <input type="text" name="login" value="<?php echo $_GET['login']; ?>" placeholder="DBMS Login" required />
        </p>
        <p>
            <span><i class="fas fa-key"></i></span>
            <input type="password" name="passwd" value="<?php echo $_GET['passwd']; ?>" placeholder="DBMS Password" />
        </p>
        <p>
            <span><i class="fas fa-database"></i></span>
            <input type="text" name="dbname" value="<?php echo $_GET['dbname']; ?>" placeholder="Name of new DB" required />
        </p>
        <p><input class="button_subm" type="submit" name="submit" value="OK" autofocus /></p>
    </form>
</div>

</body>
</html>
