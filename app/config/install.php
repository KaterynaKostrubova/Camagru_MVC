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

function db_request($exec, $login, $password, $dsn){
    try {
        $pdo = new PDO($dsn, $login, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec($exec);
    } catch (PDOException $e) {
        exit($e->getMessage());
    }
}

// Connecting to a MySQL database
$exec = 'CREATE DATABASE ' . $NAME;
db_request($exec, $login, $password, $dsn);

$dsn = 'mysql:host=localhost;dbname=' . $NAME . ';charset=UTF8';

//table users
$exec = 'CREATE TABLE users (
		id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		login VARCHAR(254) NOT NULL UNIQUE,
		sex VARCHAR(254),
		photo_id  INT(11) NOT NULL DEFAULT 1,
		bg_id INT(11) NOT NULL DEFAULT 3,
		email VARCHAR(254) UNIQUE,
		password TEXT NOT NULL,
		token TEXT NOT NULL,
		isAdmin BOOLEAN NOT NULL DEFAULT FALSE,
		isConfirm BOOLEAN NOT NULL DEFAULT FALSE,
		notification BOOLEAN NOT NULL DEFAULT TRUE,
		registrDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		sendLinkDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)';
db_request($exec, $login, $password, $dsn);


//table photos
$exec = 'CREATE TABLE photos (
		id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		path VARCHAR(254) NOT NULL UNIQUE,
		user_id INT(11) NOT NULL,
		name VARCHAR(254) NOT NULL,
		description VARCHAR(254) NOT NULL,
		creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP
	)';

db_request($exec, $login, $password, $dsn);

//add admin user
$admPass = hash('whirlpool', 'admin');

$exec = "INSERT INTO users (login, photo_id, bg_id, password, token, isadmin, isConfirm)
		VALUES ('admin', 1, 3, '" . $admPass . "','" . $admPass . "' , true, true)";

db_request($exec, $login, $password, $dsn);

//add default photo for admin users
$path = [   "/camagru_mvc/photos/male.svg",
            "/camagru_mvc/photos/female.svg",
            "/camagru_mvc/photos/bg_default.jpeg",
            "/camagru_mvc/photos/2.jpg",
            "/camagru_mvc/photos/3.jpg",
            "/camagru_mvc/photos/4.jpg",
            "/camagru_mvc/photos/5.jpg",
];

try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    for($i = 0; $i < 6; $i++){
        $pdo->exec("INSERT INTO photos (path, user_id, name, description)
		VALUES ('" . $path[$i] . "', 1 , 'admin' , 'admin')");
    }

} catch (PDOException $e) {
    exit($e->getMessage());
}

//add pack of filters/stikers
$exec = 'CREATE TABLE filters(
		id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
		path VARCHAR(254) NOT NULL UNIQUE
	)';

db_request($exec, $login, $password, $dsn);

$numberOfStikers = 12;
$path = '/camagru_mvc/public/image/stiker_';
$ext = '.png';
try {
    $pdo = new PDO($dsn, $login, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    for($i = 0; $i < $numberOfStikers; $i++) {
        $pdo->exec("INSERT INTO filters (path)
		VALUES ('" . $path . $i . $ext ."')");
    }
} catch (PDOException $e) {
    exit($e->getMessage());
}

header('Location: /camagru_mvc/account/signup');
