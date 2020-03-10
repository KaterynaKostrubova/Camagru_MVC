<?php

namespace app\models;

use app\core\Model;

class Gallery extends Model {
//    function getAllPhotos($user_id){
//        return  $this->db->row("SELECT p.id, p.path, u.login, u.photo_id FROM users u JOIN photos p ON u.id = p.user_id ORDER BY creation DESC;");
//    }

    function getAllPhotos(){
        return  $this->db->row("SELECT p.id, p.path, u.login, u.photo_id FROM users u JOIN photos p ON u.id = p.user_id ORDER BY creation DESC;");
    }

    function getAllAvatars(){
        return  $this->db->row("SELECT u.photo_id, p.path FROM users u JOIN photos p ON u.photo_id = p.id;");
    }


}
