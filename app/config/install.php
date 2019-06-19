<?php

if ($_POST["login"] == false || $_POST["passwd"] == false || $_POST["submit"] != "OK") {
    exit("BAD INPUT" . PHP_EOL);
}

include "db.php";
//$config = require ('db.php');
$login =$_POST['login'];
$password =$_POST['passwd'];
////$dsn = 'mysql:host=' . $config['host'];
$dsn = 'mysql:host=' . $HOST;

// Connecting to a MySQL database
try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = 'CREATE DATABASE ' . $NAME;
    $pdo->exec($sql);

} catch (PDOException $e) {
    exit($e->getMessage());
}

$dsn = 'mysql:host=localhost;dbname=' . $NAME . ';charset=UTF8';

try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE users (
		id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(254) NOT NULL UNIQUE,
		email VARCHAR(254) UNIQUE,
		password TEXT NOT NULL,
		isAdmin BOOLEAN NOT NULL DEFAULT FALSE
	)');
} catch (PDOException $e) {
    exit($e->getMessage());
}

$admPass = hash('whirlpool', 'admin');
try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("INSERT INTO users (login, password, isadmin)
		VALUES ('admin', '" . $admPass . "', true)");
} catch (PDOException $e) {
    exit($e->getMessage());
}
//$sql = "INSERT INTO users (username, password, isadmin)
//		VALUES ('admin', '" . $passadm . "', true),

try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE user_signup (
		id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(254) NOT NULL,
		email VARCHAR(254),
		password TEXT NOT NULL,
		token TEXT NOT NULL,
		isAdmin BOOLEAN NOT NULL DEFAULT FALSE
	)');
} catch (PDOException $e) {
    exit($e->getMessage());
}

header('Location: /camagru_mvc/account/signup');