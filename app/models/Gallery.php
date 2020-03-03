<?php

namespace app\models;

use app\core\Model;

class Gallery extends Model {

//        function getAllPhotos(){
//        return  $this->db->row("SELECT photos.path, users.login, users.photo_id FROM photos, users WHERE user_id not like 0 ORDER BY creation DESC");
//    }

    function getAllPhotos(){
        return  $this->db->row("SELECT p.path, u.login, u.photo_id FROM users u JOIN photos p ON u.id = p.user_id ORDER BY creation DESC;");
//        return  $this->db->row("SELECT path, user_id FROM photos WHERE user_id not like 0 ORDER BY creation DESC");
    }

    function getAllAvatars(){
        return  $this->db->row("SELECT u.photo_id, p.path FROM users u JOIN photos p ON u.photo_id = p.id;");
//        return  $this->db->row("SELECT photos.path, photos.user_id, users.photo_id, users.login FROM photos, users WHERE user_id not like 0 ORDER BY creation DESC");
    }

//    function getAllAvatars(){
//        return  $this->db->row("SELECT path, user_id, login FROM photos, users WHERE photos.id = users.photo_id");
//    }



//    function getOwnerAvatar(){
//        return $this->db->row("SELECT users.login, photos.path, users.id  FROM users, photos WHERE photos.id = users.photo_id");
//    }


//    function getOwnerPhoto($path){
//        return  $this->db->row("SELECT id FROM photos WHERE path='$path'");
//    }





}
