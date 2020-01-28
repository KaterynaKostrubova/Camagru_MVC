<?php

namespace app\models;

use app\core\Model;

class Main extends Model {

    public function getUsers(){
        $result = $this->db->row('SELECT login, email FROM users');
        return $result;
    }

    public function getAvatarPath($photo_id){
        return $this->db->row("SELECT path FROM photos WHERE id='$photo_id'")[0]['path'];
    }





}



