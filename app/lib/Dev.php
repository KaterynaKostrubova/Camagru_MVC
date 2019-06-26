<?php

//Sets the value of a configuration option
//відображення помилок
ini_set('display_errors', 1);
error_reporting(E_ALL);

// функція для дебага
function debug($str){
    echo '<pre>';
    var_dump($str);
//    var_dump($str1);
//    var_dump($str2);
    echo '</pre>';
    exit();
}