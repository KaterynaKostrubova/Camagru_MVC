<?php
//include 'db/connect_db.php';
//include 'images/save_img.php';
//function  connect_db()
//{
//    $DB_DSN = "mysql:dbname=CAMAGRU;host=localhost;";
//    $DB_USER = "root";
//    $DB_PASSWORD = "2410103";
//    try {
//        $pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
//    }
//    catch(PDOException $ex){
//        $msg = "Failed to connect to the database";
//    }
//
//    return ($pdo);
//}
//
//session_start();
//$pdo = connect_db();
//$id = get_last_id($pdo);
//$id++;
//save_img($id, $_POST["data"], $_POST["filter"], $_POST["x"], $_POST["y"]);
//save_into_db($id, $pdo, $_SESSION["username"]);
//echo "Success";
//

function save_img($id, $data, $filter, $x, $y)
{
    $img = imagecreatefrompng($data);
    $png = imagecreatefrompng($filter);
    imagecolortransparent($png, imagecolorat($png, 0, 0));
    imagecopymerge($img, $png, 0, 0, 0, 0, 960, 720, 100);
    imagepng($img, "images/" . $id .".png", 5);
}


//$image = imagecreate(200, 200);
//$bgr = imagecolorallocate($image, 0, 0, 0);
//$fbg = imagecolorallocate($image, 255, 255, 255);
//$img_1 = imagecreatefromjpeg('2.jpg');
//$img_2 = imagecreatefrompng('3.png');
//
//imagecolortransparent($img_2, $bgr);
//
//imagecopy($img_1, $img_2, 10, 9, 0, 0, 1000, 1400);
//header('Content-Type: image/jpeg');
//imagepng($img_1);























//$directory = "./images";    // Папка с изображениями
//$allowed_types = array("jpg", "png", "gif");  //разрешеные типы изображений
//$file_parts = array();
//$ext = "";
//$title = "";
//$i = 0;
////пробуем открыть папку
//$dir_handle = @opendir($directory) or die("Ошибка при открытии папки !!!");
//while ($file = readdir($dir_handle))    //поиск по файлам
//{
//    if ($file == "." || $file == "..") continue;  //пропустить ссылки на другие папки
//    $file_parts = explode(".", $file);          //разделить имя файла и поместить его в массив
//    $ext = strtolower(array_pop($file_parts));   //последний элеменет - это расширение
//
//
//    if (in_array($ext, $allowed_types)) {
//        echo '<div class = "blok_img" >
//                <img src="' . $directory . '/' . $file . '" class="pimg" title="' . $file . '" />
//            </div>';
//        $i++;
//    }
//
//}
//closedir($dir_handle);  //закрыть папку
