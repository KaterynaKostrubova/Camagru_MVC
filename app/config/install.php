<?php

if ($_POST["login"] == false || $_POST["passwd"] == false || $_POST["dbname"] == false  || $_POST["submit"] != "OK") {
    exit("BAD INPUT" . PHP_EOL);
}

//$DB_DSN = 'mysql:host=localhost;dbname=db_camagru;charset=UTF8';
$dbname = $_POST['dbname'];
$login =$_POST['login'];
$password =$_POST['passwd'];
$server = 'localhost';
$dsn = 'mysql:host=' . $server;
//echo $dsn;

// Connecting to a MySQL database

try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'CREATE DATABASE ' . $dbname;
    $pdo->exec($sql);

} catch (PDOException $e) {
    exit($e->getMessage());
}

$dsn = 'mysql:host=' . $server . ';dbname=' . $dbname . ';charset=utf8';
//echo $dsn;
try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE user_signup (
		id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(254) NOT NULL,
		password TEXT NOT NULL,
		email VARCHAR(254),
		token TEXT NOT NULL,
		isAdmin BOOLEAN NOT NULL DEFAULT FALSE
	)');
} catch (PDOException $e) {
    exit($e->getMessage());
}
// debug("camagru");
header('Location: /camagru_mvc/account/login');