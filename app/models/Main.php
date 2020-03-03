<?php

namespace app\models;

use app\core\Model;

class Main extends Model {

    public function getUsers(){
        $result = $this->db->row('SELECT login, email FROM users');
        return $result;
    }

    public function getPath($id){
        return $this->db->row("SELECT path FROM photos WHERE id='$id'")[0]['path'];
    }

    public function getUserPhotos($user){
        $photos = $this->db->row("SELECT path, id, user_id FROM photos WHERE user_id='$user'");
        return $photos;
    }





}



