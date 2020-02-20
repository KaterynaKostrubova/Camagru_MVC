<?php

namespace app\models;

use app\core\Model;

class Photo extends Model {

    public function getFilters(){
        return  $this->db->row("SELECT path FROM filters ORDER BY id");
    }

    public function addPhoto($path, $user_id, $name, $description){
        return $this->db->insertto("INSERT INTO photos (path, user_id, name, description) VALUE ('$path', '$user_id', '$name', '$description')");
    }

    public function getUserData($user){
        return $this->db->row("SELECT * FROM users WHERE login='$user'");
    }

    public function getEditedPhotos($id){
        return $this->db->row("SELECT path FROM photos WHERE user_id='$id'");
    }


}
