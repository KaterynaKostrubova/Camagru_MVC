<?php

namespace app\models;

use app\core\Model;

class Photo extends Model {

    public function getFilters(){
        return  $this->db->row("SELECT path FROM filters ORDER BY id DESC ");
    }

    public function addPhoto($path, $user_id, $name, $description){
        return $this->db->insertto("INSERT INTO photos (path, user_id, name, description) VALUE ('$path', '$user_id', '$name', '$description')");
    }

    public function getUserData($user){
        return $this->db->row("SELECT * FROM users WHERE login='$user'");
    }

    public function getEditedPhotos($id){
        return $this->db->row("SELECT * FROM photos WHERE user_id='$id'");
    }

    public function getIdPhoto($path){
        return $this->db->row("SELECT id FROM photos WHERE path='$path'");
    }
<<<<<<< HEAD

    public function delImage($id){
        return $this->db->delete("DELETE FROM photos WHERE id='$id'");
    }

    public function getNameImage($id){
        return $this->db->row("SELECT path FROM photos WHERE id='$id'");
=======

    public function delImage($id){
        return $this->db->delete("DELETE FROM photos WHERE id='$id'");
>>>>>>> 74567574b281b6797ed0c5842981be6fc94d7b51
    }
}
