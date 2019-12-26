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
		token TEXT NOT NULL,
		isAdmin BOOLEAN NOT NULL DEFAULT FALSE,
		isConfirm BOOLEAN NOT NULL DEFAULT FALSE,
		notification BOOLEAN NOT NULL DEFAULT TRUE,
		registrDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		sendLinkDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)');
} catch (PDOException $e) {
    exit($e->getMessage());
}

try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('CREATE TABLE photos (
		id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		path VARCHAR(254) NOT NULL UNIQUE,
		user_id INT(11) NOT NULL,
		name VARCHAR(254) NOT NULL,
		description VARCHAR(254) NOT NULL
	)');
} catch (PDOException $e) {
    exit($e->getMessage());
}

$admPass = hash('whirlpool', 'admin');

try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("INSERT INTO users (login, password, token, isadmin, isConfirm)
		VALUES ('admin', '" . $admPass . "','" . $admPass . "' , true, true)");
} catch (PDOException $e) {
    exit($e->getMessage());
}

//debug(__DIR__);
$path = ["/camagru_mvc/photos/1.jpg",
            "/camagru_mvc/photos/2.jpg",
                "/camagru_mvc/photos/3.jpg"];
try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    for($i = 0; $i < 3; $i++){
        $pdo->exec("INSERT INTO photos (path, user_id, name, description)
		VALUES ('" . $path[$i] . "', 1 , 'admin' , 'admin')");
    }

} catch (PDOException $e) {
    exit($e->getMessage());
}
//$sql = "INSERT INTO users (username, password, isadmin)
//		VALUES ('admin', '" . $passadm . "', true),

//try {
//    $pdo = new PDO($dsn, $login, $password);
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $pdo->exec('CREATE TABLE user_signup (
//		id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
//		login VARCHAR(254) NOT NULL,
//		email VARCHAR(254),
//		password TEXT NOT NULL,
//		token TEXT NOT NULL,
//		isAdmin BOOLEAN NOT NULL DEFAULT FALSE
//	)');
//} catch (PDOException $e) {
//    exit($e->getMessage());
//}


//try {
//    $pdo = new PDO($dsn, $login, $password);
//    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    $pdo->exec('CREATE TABLE change_password (
//		id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
//		login VARCHAR(254) NOT NULL,
//		email VARCHAR(254),
//		token TEXT NOT NULL
//	)');
//} catch (PDOException $e) {
//    exit($e->getMessage());
//}
//debug($_GET);
header('Location: /camagru_mvc/account/signup');
